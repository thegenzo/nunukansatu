<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Announcement;
use App\Models\AnnouncementAdmin;
use App\Models\User;
use App\Services\AnnouncementQrCode;
use Carbon\Carbon;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Request as BrowserRequest;
use GuzzleHttp\Psr7\Response as BrowserResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class AnnouncementManagementTest extends TestCase
{
    /** @dataProvider loginHosts */
    public function test_login_preserves_the_browser_session_with_csrf_verification_enabled(string $baseUrl): void
    {
        $this->enableBrowserSessions();
        $admin = $this->admin();
        $cookies = new CookieJar;
        $url = $baseUrl.'/admin/login';

        $login = $this->browserRequest($cookies, 'GET', $url)->assertOk();
        preg_match('/name="_token" value="([^"]+)"/', $login->getContent(), $token);
        $this->assertNotEmpty($token[1] ?? null);

        // CookieJar enforces browser domain matching: a production-only cookie
        // would not be sent back to localhost and the POST would return 419.
        $sentCookie = $cookies->withCookieHeader(new BrowserRequest('POST', $url))->getHeaderLine('Cookie');
        $this->assertStringContainsString(config('session.cookie').'=', $sentCookie);

        $this->browserRequest($cookies, 'POST', $url, [
            '_token' => $token[1],
            'email' => $admin->email,
            'password' => 'admin-password-123',
        ])->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));

        $this->browserRequest($cookies, 'GET', $baseUrl.'/admin/pengumuman')->assertOk();
    }

    public static function loginHosts(): array
    {
        return [
            'localhost' => ['http://localhost'],
            'production HTTPS' => ['https://nunukankab.go.id'],
        ];
    }

    public function test_login_still_rejects_a_missing_or_incorrect_csrf_token(): void
    {
        $this->enableBrowserSessions();
        $admin = $this->admin();
        $cookies = new CookieJar;
        $url = 'http://localhost/admin/login';
        $this->browserRequest($cookies, 'GET', $url)->assertOk();

        foreach ([null, 'invalid-token'] as $token) {
            $this->browserRequest($cookies, 'POST', $url, [
                '_token' => $token,
                'email' => $admin->email,
                'password' => 'admin-password-123',
            ])->assertStatus(419);
        }
        $this->assertGuest('announcement_admin');
    }

    private function enableBrowserSessions(): void
    {
        Storage::disk('local')->makeDirectory('browser-sessions');
        config([
            'session.driver' => 'file',
            'session.files' => Storage::disk('local')->path('browser-sessions'),
        ]);

        // Laravel bypasses CSRF during normal feature tests. Enable it here so
        // this regression exercises the same token check as a real login.
        $this->app->instance(VerifyCsrfToken::class, new class($this->app, $this->app['encrypter']) extends VerifyCsrfToken
        {
            protected function runningUnitTests()
            {
                return false;
            }
        });
    }

    private function browserRequest(CookieJar $jar, string $method, string $url, array $data = [])
    {
        Auth::forgetGuards();
        $this->app['session']->forgetDrivers();
        $this->app->forgetInstance('session.store');

        $request = $jar->withCookieHeader(new BrowserRequest($method, $url));
        $cookies = [];
        foreach (explode('; ', $request->getHeaderLine('Cookie')) as $cookie) {
            if (str_contains($cookie, '=')) {
                [$name, $value] = explode('=', $cookie, 2);
                $cookies[$name] = rawurldecode($value);
            }
        }
        $response = $this->call($method, $url, $data, $cookies);
        $jar->extractCookies($request, new BrowserResponse($response->getStatusCode(), [
            'Set-Cookie' => $response->headers->all('set-cookie'),
        ]));

        return $response;
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Never run migrations against the database configured in the local .env.
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.url' => null,
            'cache.default' => 'array',
            'session.driver' => 'array',
        ]);
        DB::purge('sqlite');
        $this->assertSame(':memory:', DB::connection()->getDatabaseName());

        Storage::fake('local');
        Storage::fake('public');
        $this->artisan('migrate', ['--force' => true])->assertExitCode(0);
        Announcement::query()->delete();
        $this->travelTo(now()->setDate(2026, 10, 28)->setTime(8, 0));
    }

    public function test_guests_cannot_read_or_mutate_the_admin_dashboard(): void
    {
        $announcement = $this->announcement();

        foreach (['index', 'create'] as $action) {
            $this->get(route('admin.announcements.'.$action))
                ->assertRedirect(route('admin.login'));
        }

        foreach (['edit', 'preview', 'pdf', 'qr'] as $action) {
            $this->get(route('admin.announcements.'.$action, $announcement))
                ->assertRedirect(route('admin.login'));
        }

        $this->post(route('admin.announcements.store'), $this->payload())
            ->assertRedirect(route('admin.login'));
        $this->put(route('admin.announcements.update', $announcement), $this->payload())
            ->assertRedirect(route('admin.login'));
        $this->delete(route('admin.announcements.destroy', $announcement))
            ->assertRedirect(route('admin.login'));

        $this->assertDatabaseCount('announcements', 1);
        Storage::disk('local')->assertExists($announcement->pdf_path);
    }

    public function test_a_public_user_session_does_not_grant_announcement_admin_access(): void
    {
        $user = User::create([
            'nik' => '1234567890123456',
            'name' => 'Pengguna Publik',
            'phone' => '081234567890',
            'password' => 'public-password',
            'verified' => true,
        ]);
        $this->actingAs($user, 'web');

        $this->get(route('admin.announcements.index'))->assertRedirect(route('admin.login'));
        $this->post(route('admin.announcements.store'), $this->payload())
            ->assertRedirect(route('admin.login'));
        $this->assertDatabaseCount('announcements', 0);
    }

    public function test_an_admin_can_create_edit_replace_and_delete_an_uploaded_announcement(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');
        $this->get(route('admin.announcements.index'))->assertOk();
        $this->get(route('admin.announcements.create'))->assertOk();

        $this->post(route('admin.announcements.store'), $this->payload([
            'pdf' => $this->pdfUpload(),
            'is_active' => '1',
            'show_qr' => '1',
        ]))->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));

        $announcement = Announcement::sole();
        $originalPath = $announcement->pdf_path;
        $this->assertTrue(Str::isUuid($announcement->public_id));
        $this->assertSame('local', $announcement->pdf_disk);
        $this->assertStringStartsWith('announcements/', $originalPath);
        $this->assertNotSame('announcements/pengumuman.pdf', $originalPath);
        $this->assertSame('pengumuman.pdf', $announcement->pdf_file_name);
        Storage::disk('local')->assertExists($originalPath);
        Storage::disk('public')->assertMissing($originalPath);

        $this->get(route('admin.announcements.edit', $announcement))->assertOk()->assertSee($announcement->title);
        $this->put(route('admin.announcements.update', $announcement), $this->payload([
            'title' => 'Pengumuman yang sudah diperbarui',
            'is_active' => '0',
            'show_qr' => '0',
        ]))->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));

        $announcement->refresh();
        $this->assertSame('Pengumuman yang sudah diperbarui', $announcement->title);
        $this->assertFalse($announcement->is_active);
        $this->assertFalse($announcement->show_qr);
        $this->assertSame($originalPath, $announcement->pdf_path);
        $this->get(route('admin.announcements.preview', $announcement))->assertOk();
        $this->get(route('web.announcements.show', $announcement))->assertNotFound();

        $this->put(route('admin.announcements.update', $announcement), $this->payload([
            'pdf' => $this->pdfUpload('pengumuman-baru.pdf'),
            'is_active' => '1',
        ]))->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));

        $announcement->refresh();
        $this->assertNotSame($originalPath, $announcement->pdf_path);
        Storage::disk('local')->assertMissing($originalPath);
        Storage::disk('local')->assertExists($announcement->pdf_path);

        $this->delete(route('admin.announcements.destroy', $announcement))
            ->assertRedirect(route('admin.announcements.index'));
        $this->assertDatabaseMissing('announcements', ['id' => $announcement->id]);
        Storage::disk('local')->assertMissing($announcement->pdf_path);
    }

    public function test_replacing_or_deleting_an_imported_pdf_preserves_the_original_public_file(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');
        Storage::disk('public')->put('pengumuman-lama.pdf', $this->pdfContent());
        $imported = $this->announcement([
            'pdf_disk' => 'public',
            'pdf_path' => 'pengumuman-lama.pdf',
        ]);

        $this->put(route('admin.announcements.update', $imported), $this->payload([
            'pdf' => $this->pdfUpload(),
        ]))->assertSessionHasNoErrors();
        Storage::disk('public')->assertExists('pengumuman-lama.pdf');

        $another = $this->announcement([
            'pdf_disk' => 'public',
            'pdf_path' => 'pengumuman-lama.pdf',
        ]);
        $this->delete(route('admin.announcements.destroy', $another))->assertRedirect();
        Storage::disk('public')->assertExists('pengumuman-lama.pdf');
    }

    public function test_deleting_an_announcement_cannot_delete_an_unmanaged_local_file(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');
        $announcement = $this->announcement(['pdf_path' => 'other-documents/important.pdf']);

        $this->delete(route('admin.announcements.destroy', $announcement))->assertRedirect();

        Storage::disk('local')->assertExists('other-documents/important.pdf');
    }

    public function test_public_preview_escapes_text_and_serves_the_uploaded_pdf_inline(): void
    {
        $announcement = $this->announcement([
            'title' => '<script>alert("title")</script>',
            'subtitle' => '<img src=x onerror=alert(1)>',
            'message' => '<script>alert("message")</script>',
        ]);

        $this->get(route('web.announcements.show', $announcement))
            ->assertOk()
            ->assertSee($announcement->title)
            ->assertSee($announcement->subtitle)
            ->assertSee($announcement->message)
            ->assertDontSee($announcement->title, false)
            ->assertDontSee($announcement->subtitle, false)
            ->assertDontSee($announcement->message, false)
            ->assertSee(route('web.announcements.pdf', $announcement), false);

        $response = $this->get(route('web.announcements.pdf', $announcement));
        $response->assertOk()->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringStartsWith('inline;', $response->headers->get('Content-Disposition'));
        $this->assertSame($this->pdfContent(), file_get_contents($response->baseResponse->getFile()->getPathname()));
    }

    public function test_disabled_future_and_expired_announcements_are_not_publicly_accessible(): void
    {
        foreach ([
            ['is_active' => false],
            ['starts_at' => now()->addDay()],
            ['ends_at' => now()->subSecond()],
        ] as $attributes) {
            $announcement = $this->announcement($attributes);

            $this->get(route('web.announcements.show', $announcement))->assertNotFound();
            $this->get(route('web.announcements.pdf', $announcement))->assertNotFound();
            $this->get(route('web.announcements.qr', $announcement))->assertNotFound();
        }
    }

    public function test_home_shows_the_most_recent_eligible_announcement_only(): void
    {
        $older = $this->announcement(['title' => 'Pengumuman aktif terdahulu']);
        $older->forceFill(['updated_at' => now()->subDay()])->save();
        $current = $this->announcement(['title' => 'Pengumuman aktif terbaru']);
        $this->announcement(['title' => 'Pengumuman nonaktif rahasia', 'is_active' => false]);
        $this->announcement(['title' => 'Pengumuman belum dijadwalkan tampil', 'starts_at' => now()->addDay()]);
        $this->announcement(['title' => 'Pengumuman sudah kedaluwarsa', 'ends_at' => now()->subDay()]);

        $this->get(route('web.home'))->assertOk()
            ->assertSee($current->title)
            ->assertSee(route('web.announcements.show', $current), false)
            ->assertDontSee($older->title)
            ->assertDontSee('Pengumuman nonaktif rahasia')
            ->assertDontSee('Pengumuman belum dijadwalkan tampil')
            ->assertDontSee('Pengumuman sudah kedaluwarsa');
    }

    public function test_home_omits_the_popup_when_there_is_no_visible_announcement(): void
    {
        $this->announcement(['title' => 'Popup dinonaktifkan', 'is_active' => false]);

        $this->get(route('web.home'))->assertOk()
            ->assertDontSee('Popup dinonaktifkan')
            ->assertDontSee('id="pengumumanJptModal"', false);
    }

    public function test_upload_validation_rejects_missing_title_non_pdf_and_oversized_files(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');

        $this->post(route('admin.announcements.store'), $this->payload([
            'title' => '',
            'pdf' => $this->pdfUpload(),
        ]))->assertSessionHasErrors('title');
        $this->post(route('admin.announcements.store'), $this->payload([
            'pdf' => UploadedFile::fake()->createWithContent('document.pdf', '<html>Not a PDF</html>')->mimeType('text/html'),
        ]))->assertSessionHasErrors('pdf');
        $this->post(route('admin.announcements.store'), $this->payload([
            'pdf' => UploadedFile::fake()->create('large.pdf', 20481, 'application/pdf'),
        ]))->assertSessionHasErrors('pdf');
        $this->post(route('admin.announcements.store'), $this->payload())
            ->assertSessionHasErrors('pdf');

        $this->assertDatabaseCount('announcements', 0);
        $this->assertSame([], Storage::disk('local')->allFiles('announcements'));
    }

    public function test_a_schedule_must_end_after_it_starts(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');

        $this->post(route('admin.announcements.store'), $this->payload([
            'pdf' => $this->pdfUpload(),
            'starts_at' => '2026-11-02T10:00',
            'ends_at' => '2026-11-01T10:00',
        ]))->assertSessionHasErrors('ends_at');

        $this->assertDatabaseCount('announcements', 0);
    }

    public function test_schedule_dates_entered_in_wita_are_stored_in_the_application_timezone(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');

        $this->post(route('admin.announcements.store'), $this->payload([
            'pdf' => $this->pdfUpload(),
            'starts_at' => '2026-11-02T10:00',
            'ends_at' => '2026-11-02T11:00',
        ]))->assertSessionHasNoErrors();

        $announcement = Announcement::sole();
        $expectedStart = Carbon::parse('2026-11-02 10:00', 'Asia/Makassar')->timezone(config('app.timezone'));
        $expectedEnd = Carbon::parse('2026-11-02 11:00', 'Asia/Makassar')->timezone(config('app.timezone'));
        $this->assertTrue($announcement->starts_at->equalTo($expectedStart));
        $this->assertTrue($announcement->ends_at->equalTo($expectedEnd));
        $this->get(route('admin.announcements.edit', $announcement))
            ->assertOk()->assertSee('2026-11-02T10:00', false)->assertSee('2026-11-02T11:00', false);

        $this->travelTo($expectedStart);
        $this->get(route('web.announcements.show', $announcement))->assertOk();
        $this->travelTo($expectedEnd);
        $this->get(route('web.announcements.show', $announcement))->assertNotFound();
    }

    public function test_downloaded_qr_contains_the_stable_public_preview_link_on_the_configured_domain(): void
    {
        config(['app.url' => 'https://nunukankab.go.id']);
        $this->actingAs($this->admin(), 'announcement_admin');
        $announcement = $this->announcement();
        $expectedUrl = 'https://nunukankab.go.id/pengumuman/'.$announcement->public_id;

        $this->assertSame($expectedUrl, app(AnnouncementQrCode::class)->previewUrl($announcement));
        $response = $this->get(route('admin.announcements.qr', $announcement));
        $response->assertOk();
        $this->assertStringContainsString('image/svg+xml', $response->headers->get('Content-Type'));
        $this->assertStringStartsWith('attachment;', $response->headers->get('Content-Disposition'));
        $svg = simplexml_load_string($response->getContent());
        $this->assertNotFalse($svg);
        $this->assertSame($expectedUrl, (string) $svg->title);
        $this->assertNotEmpty($svg->g);
    }

    public function test_an_admin_can_publish_an_external_pdf_url_and_choose_whether_to_show_qr(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');
        $url = 'https://assets.example.test/hasil-seleksi.pdf';

        $this->post(route('admin.announcements.store'), $this->payload([
            'document_source' => 'url',
            'pdf_url' => $url,
            'is_active' => '1',
            'show_qr' => '0',
        ]))->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));

        $announcement = Announcement::sole();
        $this->assertSame($url, $announcement->pdf_url);
        $this->assertFalse($announcement->show_qr);
        $this->assertSame([], Storage::disk('local')->allFiles('announcements'));
        $this->get(route('web.announcements.pdf', $announcement))->assertRedirect($url);

        $this->put(route('admin.announcements.update', $announcement), $this->payload([
            'document_source' => 'url',
            'pdf_url' => $url,
            'show_qr' => '1',
        ]))->assertSessionHasNoErrors();
        $this->assertTrue($announcement->fresh()->show_qr);
    }

    public function test_external_document_links_reject_unsafe_url_schemes(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');

        foreach (['javascript:alert(1)', 'file:///etc/passwd', 'ftp://example.test/file.pdf'] as $url) {
            $this->post(route('admin.announcements.store'), $this->payload([
                'document_source' => 'url',
                'pdf_url' => $url,
            ]))->assertSessionHasErrors('pdf_url');
        }

        $this->assertDatabaseCount('announcements', 0);
    }

    public function test_switching_between_upload_and_external_link_replaces_the_document_source(): void
    {
        $this->actingAs($this->admin(), 'announcement_admin');
        $announcement = $this->announcement();
        $oldPath = $announcement->pdf_path;

        $this->put(route('admin.announcements.update', $announcement), $this->payload([
            'document_source' => 'url',
            'pdf_url' => 'https://assets.example.test/announcement.pdf',
        ]))->assertSessionHasNoErrors();
        $announcement->refresh();
        $this->assertNull($announcement->pdf_path);
        Storage::disk('local')->assertMissing($oldPath);

        $this->put(route('admin.announcements.update', $announcement), $this->payload([
            'document_source' => 'file',
        ]))->assertSessionHasErrors('pdf');
        $this->put(route('admin.announcements.update', $announcement), $this->payload([
            'document_source' => 'file',
            'pdf' => $this->pdfUpload('replacement.pdf'),
        ]))->assertSessionHasNoErrors();
        $announcement->refresh();
        $this->assertNull($announcement->pdf_url);
        $this->assertSame('replacement.pdf', $announcement->pdf_file_name);
        Storage::disk('local')->assertExists($announcement->pdf_path);
    }

    public function test_admin_login_and_logout_use_the_separate_admin_guard(): void
    {
        $admin = $this->admin();
        $this->assertTrue(Hash::check('admin-password-123', $admin->password));
        $this->assertArrayNotHasKey('password', $admin->toArray());
        $this->get(route('admin.login'))->assertOk();

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'admin-password-123',
            'remember' => '1',
        ])->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));

        $this->assertAuthenticatedAs($admin, 'announcement_admin');
        $this->assertGuest('web');
        $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
        $this->assertGuest('announcement_admin');
        $this->get(route('admin.announcements.index'))->assertRedirect(route('admin.login'));
    }

    public function test_invalid_admin_credentials_do_not_log_a_user_in(): void
    {
        $admin = $this->admin();

        $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ])->assertRedirect(route('admin.login'))->assertSessionHasErrors('email');

        $this->assertGuest('announcement_admin');
    }

    public function test_resetting_an_admin_password_revokes_the_existing_dashboard_session(): void
    {
        $admin = $this->admin();
        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'admin-password-123',
        ])->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));
        $this->get(route('admin.announcements.index'))->assertOk();
        $this->assertSame($admin->password, session('announcement_admin_password_hash'));

        AnnouncementAdmin::query()->whereKey($admin->id)->update([
            'password' => Hash::make('replacement-password-456'),
        ]);
        // A new HTTP request must load the updated account rather than a cached guard user.
        Auth::forgetGuards();

        $this->get(route('admin.announcements.index'))
            ->assertRedirect(route('admin.login'))->assertSessionHasErrors('email');
        $this->assertGuest('announcement_admin');
        $this->post(route('admin.announcements.store'), $this->payload([
            'pdf' => $this->pdfUpload(),
        ]))->assertRedirect(route('admin.login'));
        $this->assertDatabaseCount('announcements', 0);

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'replacement-password-456',
        ])->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));
        $this->get(route('admin.announcements.index'))->assertOk();
    }

    public function test_the_admin_command_hashes_passwords_and_rejects_mismatched_confirmation(): void
    {
        $options = ['--email' => 'ADMIN@example.test', '--name' => 'Admin Pengumuman'];
        $this->artisan('announcements:admin', $options)
            ->expectsQuestion('Kata sandi baru (minimal 12 karakter)', 'command-password-123')
            ->expectsQuestion('Ulangi kata sandi baru', 'command-password-123')
            ->assertExitCode(0);

        $admin = AnnouncementAdmin::sole();
        $originalPassword = $admin->password;
        $originalRememberToken = $admin->remember_token;
        $this->assertSame('admin@example.test', $admin->email);
        $this->assertNotSame('command-password-123', $originalPassword);
        $this->assertTrue(Hash::check('command-password-123', $originalPassword));

        $this->artisan('announcements:admin', $options)
            ->expectsQuestion('Kata sandi baru (minimal 12 karakter)', 'replacement-password-456')
            ->expectsQuestion('Ulangi kata sandi baru', 'different-password-789')
            ->assertExitCode(1);
        $this->assertDatabaseCount('announcement_admins', 1);
        $this->assertSame($originalPassword, $admin->fresh()->password);
        $this->assertSame($originalRememberToken, $admin->fresh()->remember_token);

        $this->artisan('announcements:admin', $options)
            ->expectsQuestion('Kata sandi baru (minimal 12 karakter)', 'replacement-password-456')
            ->expectsQuestion('Ulangi kata sandi baru', 'replacement-password-456')
            ->assertExitCode(0);
        $this->assertDatabaseCount('announcement_admins', 1);
        $this->assertTrue(Hash::check('replacement-password-456', $admin->fresh()->password));
        $this->assertNotSame($originalRememberToken, $admin->fresh()->remember_token);
    }

    public function test_admin_login_is_throttled_after_repeated_failed_attempts(): void
    {
        $admin = $this->admin();

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('admin.login.store'), [
                'email' => $admin->email,
                'password' => 'wrong-password',
            ]);
        }

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'admin-password-123',
        ])->assertSessionHasErrors('email');
        $this->assertGuest('announcement_admin');
    }

    private function admin(): AnnouncementAdmin
    {
        return AnnouncementAdmin::create([
            'name' => 'Admin Pengumuman',
            'email' => 'admin@example.test',
            'password' => 'admin-password-123',
        ]);
    }

    private function announcement(array $attributes = []): Announcement
    {
        $attributes = array_replace([
            'title' => 'Pengumuman untuk masyarakat',
            'subtitle' => 'Pemerintah Kabupaten Nunukan',
            'message' => 'Silakan membaca dokumen pengumuman berikut.',
            'reference_number' => 'B/16/PANSEL2026',
            'published_on' => '2026-10-28',
            'is_active' => true,
            'show_qr' => true,
            'pdf_disk' => 'local',
            'pdf_path' => 'announcements/'.Str::uuid().'.pdf',
            'pdf_file_name' => 'pengumuman.pdf',
        ], $attributes);
        Storage::disk($attributes['pdf_disk'])->put($attributes['pdf_path'], $this->pdfContent());

        return Announcement::create($attributes);
    }

    private function payload(array $attributes = []): array
    {
        return array_replace([
            'title' => 'Pengumuman hasil seleksi',
            'subtitle' => 'Sekretaris Daerah Kabupaten Nunukan Tahun 2026',
            'message' => 'Silakan membaca hasil seleksi pada dokumen terlampir.',
            'reference_number' => 'B/16/PANSEL2026',
            'published_on' => '2026-10-28',
            'is_active' => '1',
            'show_qr' => '1',
        ], $attributes);
    }

    private function pdfUpload(string $name = 'pengumuman.pdf'): UploadedFile
    {
        return UploadedFile::fake()->createWithContent($name, $this->pdfContent());
    }

    private function pdfContent(): string
    {
        return "%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\ntrailer\n<< /Root 1 0 R >>\n%%EOF\n";
    }
}
