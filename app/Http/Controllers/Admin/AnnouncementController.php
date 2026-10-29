<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAnnouncementRequest;
use App\Models\Announcement;
use App\Services\AnnouncementQrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.announcements.index', [
            'announcements' => Announcement::latest('updated_at')->latest('id')->paginate(12),
            'stats' => [
                'total' => Announcement::count(),
                'active' => Announcement::visible()->count(),
                'scheduled' => Announcement::where('is_active', true)->where('starts_at', '>', now())->count(),
            ],
        ]);
    }

    public function create()
    {
        return view('admin.announcements.form', ['announcement' => new Announcement(['show_qr' => true])]);
    }

    public function store(SaveAnnouncementRequest $request)
    {
        $this->save($request, new Announcement);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.form', compact('announcement'));
    }

    public function update(SaveAnnouncementRequest $request, Announcement $announcement)
    {
        $this->save($request, $announcement);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    private function save(SaveAnnouncementRequest $request, Announcement $announcement): void
    {
        $data = $request->announcementData();
        $oldDisk = $announcement->pdf_disk;
        $oldPath = $announcement->pdf_path;
        $newPath = null;

        if ($request->input('document_source') === 'url') {
            $data += ['pdf_path' => null, 'pdf_file_name' => null, 'pdf_disk' => 'local'];
        } elseif ($request->hasFile('pdf')) {
            $newPath = $request->file('pdf')->store('announcements', 'local');
            abort_unless($newPath, 500, 'File PDF gagal disimpan. Silakan coba lagi.');
            $data += [
                'pdf_path' => $newPath,
                'pdf_disk' => 'local',
                'pdf_file_name' => mb_substr(basename($request->file('pdf')->getClientOriginalName()), 0, 255),
            ];
        }

        try {
            DB::transaction(fn () => $announcement->fill($data)->save());
        } catch (Throwable $exception) {
            if ($newPath) {
                Storage::disk('local')->delete($newPath);
            }
            throw $exception;
        }

        if ($oldPath !== $announcement->pdf_path) {
            $this->deleteManagedPdf($oldDisk, $oldPath);
        }
    }

    public function destroy(Announcement $announcement)
    {
        $disk = $announcement->pdf_disk;
        $path = $announcement->pdf_path;
        $announcement->delete();
        $this->deleteManagedPdf($disk, $path);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function deleteManagedPdf(?string $disk, ?string $path): void
    {
        // Only remove files owned by this feature, never existing shared documents.
        if ($disk === 'local' && $path && str_starts_with($path, 'announcements/')) {
            Storage::disk('local')->delete($path);
        }
    }

    public function preview(Announcement $announcement, AnnouncementQrCode $qr)
    {
        return response()->view('web.pages.announcement-preview', [
            'announcement' => $announcement,
            'pdfUrl' => route('admin.announcements.pdf', $announcement),
            'previewUrl' => $qr->previewUrl($announcement),
            'isAdminPreview' => true,
        ])->header('Cache-Control', 'no-store');
    }

    public function pdf(Announcement $announcement)
    {
        return app(\App\Http\Controllers\AnnouncementController::class)->pdfResponse($announcement);
    }

    public function qr(Announcement $announcement, AnnouncementQrCode $qr)
    {
        return response($qr->svg($announcement))
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="qr-pengumuman-'.$announcement->public_id.'.svg"')
            ->header('Cache-Control', 'no-store');
    }
}
