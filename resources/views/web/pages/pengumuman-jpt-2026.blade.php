<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Seleksi JPT Pratama 2026</title>
    <link rel="icon" href="{{ asset('assets/favnunukan.png') }}" type="image/png">
    <style>
        html,
        body {
            margin: 0;
            height: 100%;
            background: #f5f5f5;
            font-family: Roboto, Arial, sans-serif;
        }

        .pdf-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 12px 20px;
            background: #fff;
            border-bottom: 1px solid #ececec;
        }

        .pdf-preview-header h1 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: #1f1f1f;
            line-height: 1.4;
        }

        .pdf-preview-header a {
            color: #d32f2f;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
        }

        .pdf-preview-frame {
            display: block;
            width: 100%;
            height: calc(100vh - 53px);
            border: 0;
            background: #525659;
        }
    </style>
</head>

<body>
    <div class="pdf-preview-header">
        <h1>Preview Pengumuman Seleksi JPT Pratama Sekretaris Daerah Kabupaten Nunukan Tahun 2026</h1>
        <a href="{{ route('web.home') }}">Kembali</a>
    </div>
    <embed class="pdf-preview-frame" src="{{ $pdfUrl }}" type="application/pdf">
</body>

</html>
