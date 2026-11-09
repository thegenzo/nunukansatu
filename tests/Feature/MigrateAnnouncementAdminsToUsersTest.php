<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Tests\TestCase;

class MigrateAnnouncementAdminsToUsersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.url' => null,
            'cache.default' => 'array',
            'session.driver' => 'array',
        ]);
        DB::purge('sqlite');
        (require database_path('migrations/2014_10_12_000000_create_users_table.php'))->up();
        (require database_path('migrations/2026_10_28_000001_create_announcement_admins_table.php'))->up();
    }

    public function test_legacy_admins_move_without_changing_hashes_public_users_or_user_relations(): void
    {
        $public = User::create([
            'name' => 'Pengguna publik', 'nik' => '1234567890123456', 'phone' => '081234567890',
            'password' => 'public-password-123', 'verified' => false,
        ]);
        $original = $public->refresh()->getRawOriginal();
        Schema::create('test_user_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
        });
        DB::table('test_user_relations')->insert(['user_id' => $public->id]);
        $hash = $this->legacyAdmin();

        $migration = $this->migration();
        $migration->up();

        $this->assertFalse(Schema::hasTable('announcement_admins'));
        $this->assertDatabaseCount('users', 2);
        $this->assertSame($original, array_intersect_key($public->fresh()->getRawOriginal(), $original));
        $this->assertFalse($public->fresh()->is_admin);
        $this->assertDatabaseHas('test_user_relations', ['user_id' => $public->id]);
        $this->assertSame([], DB::select('PRAGMA foreign_key_check'));
        $this->assertSame(1, DB::selectOne('PRAGMA foreign_keys')->foreign_keys);

        $admin = User::where('email', 'legacy@example.test')->sole();
        $this->assertTrue($admin->is_admin);
        $this->assertSame($hash, $admin->password);
        $this->assertNull($admin->nik);
        $this->assertNull($admin->phone);
        $this->assertNull($admin->remember_token);
        $this->post(route('admin.login.store'), [
            'email' => 'legacy@example.test', 'password' => 'legacy-password-123',
        ])->assertSessionHasNoErrors()->assertRedirect(route('admin.announcements.index'));
        $this->assertAuthenticatedAs($admin, 'web');

        // Existing phone uniqueness must survive SQLite's nullable-column rebuild.
        $this->assertTrue(collect(Schema::getIndexes('users'))->contains(fn ($index) => $index['unique'] && $index['columns'] === ['phone']));

        $migration->down();
        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('announcement_admins', ['email' => $admin->email, 'password' => $hash]);
        $migration->up();
        $this->assertDatabaseCount('users', 2);
        $this->assertFalse(Schema::hasTable('announcement_admins'));
    }

    public function test_conflicting_accounts_abort_migration_without_overwriting_either_password(): void
    {
        Schema::table('users', fn (Blueprint $table) => $table->string('email')->nullable()->unique());
        $public = User::create([
            'name' => 'Pemilik email', 'email' => 'legacy@example.test', 'nik' => '1234567890123456',
            'phone' => '081234567890', 'password' => 'public-password-123', 'verified' => true,
        ]);
        $originalHash = $public->password;
        $legacyHash = $this->legacyAdmin();

        try {
            $this->migration()->up();
            $this->fail('Expected an account collision to stop the migration.');
        } catch (RuntimeException $exception) {
            $this->assertStringContainsString('kredensial berbeda', $exception->getMessage());
        }

        $this->assertSame($originalHash, $public->fresh()->password);
        $this->assertDatabaseHas('announcement_admins', ['password' => $legacyHash]);
        $this->assertDatabaseCount('users', 1);
        $this->assertFalse(Schema::hasColumn('users', 'is_admin'));
    }

    public function test_matching_accounts_are_reused_without_losing_the_public_profile(): void
    {
        Schema::table('users', fn (Blueprint $table) => $table->string('email')->nullable()->unique());
        $hash = $this->legacyAdmin();
        $user = User::create([
            'name' => 'Nama pengguna tetap', 'email' => 'LEGACY@example.test', 'nik' => '1234567890123456',
            'phone' => '081234567890', 'password' => $hash, 'verified' => false,
        ]);

        $this->migration()->up();

        $this->assertDatabaseCount('users', 1);
        $this->assertTrue($user->fresh()->is_admin);
        $this->assertFalse($user->fresh()->verified);
        $this->assertSame('Nama pengguna tetap', $user->fresh()->name);
        $this->assertSame('1234567890123456', $user->fresh()->nik);
        $this->assertSame('081234567890', $user->fresh()->phone);
        $this->assertSame('legacy@example.test', $user->fresh()->email);
        $this->assertSame($hash, $user->fresh()->password);
    }

    private function migration()
    {
        return require database_path('migrations/2026_11_09_000001_move_announcement_admins_to_users.php');
    }

    private function legacyAdmin(): string
    {
        $hash = Hash::make('legacy-password-123');
        DB::table('announcement_admins')->insert([
            'name' => 'Admin lama', 'email' => 'LEGACY@example.test', 'password' => $hash,
            'remember_token' => 'old-remember-token', 'created_at' => now(), 'updated_at' => now(),
        ]);

        return $hash;
    }
}
