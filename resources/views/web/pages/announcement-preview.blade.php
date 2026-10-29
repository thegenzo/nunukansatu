<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $announcement->title }} - Nunukan Satu</title>
    <link rel="icon" href="{{ asset('assets/favnunukan.png') }}" type="image/png">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; color: #20252c; background: #f4f5f7; }
        .preview-page { min-height: 100dvh; display: flex; flex-direction: column; }
        header { padding: 20px; background: white; border-bottom: 1px solid #ddd; }
        h1 { margin: 0 0 8px; font-size: 20px; line-height: 1.4; }
        p { line-height: 1.6; margin: 8px 0; }
        .actions { display: flex; flex-wrap: wrap; gap: 16px; margin-top: 12px; }
        a { color: #b91c36; font-weight: bold; }
        .notice { padding: 12px; background: #fff3cd; border-radius: 8px; }
        .message { white-space: pre-line; }
        object { display: block; width: 100%; flex: 1; min-height: 75dvh; border: 0; }
        .fallback { padding: 24px; }
    </style>
</head>
<body>
<main class="preview-page">
    <header>
        @if($isAdminPreview)
            <p class="notice">Preview admin. Tautan publik dan QR hanya dapat dibuka saat pengumuman aktif sesuai jadwal.</p>
        @endif
        <h1>{{ $announcement->title }}</h1>
        @if($announcement->subtitle)<p>{{ $announcement->subtitle }}</p>@endif
        @if($announcement->reference_number)<p>Nomor: {{ $announcement->reference_number }}</p>@endif
        @if($announcement->published_on)<p>{{ $announcement->published_on->locale('id')->translatedFormat('d F Y') }}</p>@endif
        @if($announcement->message)<p class="message">{{ $announcement->message }}</p>@endif
        <nav class="actions" aria-label="Navigasi pengumuman">
            <a href="{{ $isAdminPreview ? route('admin.announcements.index') : route('web.home') }}">{{ $isAdminPreview ? 'Kembali ke dashboard' : 'Kembali ke beranda' }}</a>
            <a href="{{ $pdfUrl }}" target="_blank" rel="noopener noreferrer">Buka PDF</a>
            @if($isAdminPreview)
                <a href="{{ $previewUrl }}" target="_blank" rel="noopener noreferrer">Tautan publik</a>
            @endif
        </nav>
    </header>
    <object data="{{ $pdfUrl }}" type="application/pdf" aria-label="Preview PDF {{ $announcement->title }}">
        <div class="fallback"><p>Preview PDF tidak tersedia di browser ini.</p><a href="{{ $pdfUrl }}" target="_blank" rel="noopener noreferrer">Buka file PDF</a></div>
    </object>
</main>
</body>
</html>
