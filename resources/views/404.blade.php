<!-- resources/views/404.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url ('/assets/favnunukan.png')}}" type="image/png" sizes="16x16">
    <title>Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="{{ url ('/vendor/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Arial', sans-serif;
            background: radial-gradient(#e42127, #971f26), black;
            background-position-x: center;
            background-position-y: top;
            color: #fff;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 60px;
            margin-bottom: 20px;
            color: #fff;
        }

        .logo-app-404 {
            width: auto;
            height: 284px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

    </style>
</head>
<body>
    <div class="text-center">
        <img src="{{ url ('/assets/favnunukan.png')}}" class="logo-app-404"/>
    </div>
    <h1>Halaman Tidak Ditemukan</h1>
    <p>Halaman yang Anda cari mungkin telah dihapus atau tidak lagi tersedia.</p>
    <a href="{{ url('/') }}" class="btn btn-light">kembali ke home</a>
</body>
</html>
