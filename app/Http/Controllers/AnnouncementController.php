<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Services\AnnouncementQrCode;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function show(Announcement $announcement)
    {
        abort_unless($announcement->isCurrentlyVisible(), 404);

        return response()->view('web.pages.announcement-preview', [
            'announcement' => $announcement,
            'pdfUrl' => route('web.announcements.pdf', $announcement),
            'isAdminPreview' => false,
        ])->header('Cache-Control', 'no-store');
    }

    public function pdf(Announcement $announcement)
    {
        abort_unless($announcement->isCurrentlyVisible(), 404);

        return $this->pdfResponse($announcement);
    }

    public function pdfResponse(Announcement $announcement)
    {
        if ($announcement->pdf_url) {
            return redirect()->away($announcement->pdf_url)->header('Cache-Control', 'no-store');
        }

        abort_unless(in_array($announcement->pdf_disk, ['local', 'public'], true), 404);
        abort_unless($announcement->pdf_path && Storage::disk($announcement->pdf_disk)->exists($announcement->pdf_path), 404);

        return response()->file(Storage::disk($announcement->pdf_disk)->path($announcement->pdf_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="pengumuman-'.$announcement->public_id.'.pdf"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'no-store',
        ]);
    }

    public function qr(Announcement $announcement, AnnouncementQrCode $qr)
    {
        abort_unless($announcement->isCurrentlyVisible(), 404);

        return response($qr->svg($announcement))
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'no-store');
    }
}
