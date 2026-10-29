<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nunukan Satu - Kantor Daring</title>
    <link rel="icon" href="{{ asset('assets/favnunukan.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('web-assets/style.css')}}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>

    <!-- Main Background -->
    <div class="main-background"></div>

    <!-- Header / Navbar -->
    <nav class="navbar fixed-top mt-4">
        <div class="container d-flex justify-content-center">
            <div class="floating-nav bg-white rounded-pill px-4 py-2 shadow-sm d-flex align-items-center justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Logo Area -->
                    <img src="https://nunukankab.go.id/web-assets/assets/img/Nunukansatu Logo1 2.png" alt="Nunukan Satu Logo" height="40">
                
                    <!-- Search Button -->
                    <button id="searchBtn" class="btn btn-primary-red rounded-3 px-4 py-2 d-flex align-items-center gap-2" style="margin-left: 80px;">
                        <i class="bi bi-search"></i>
                        <span>Search</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content / Central Button (Desktop) -->
    <main class="container-fluid d-flex justify-content-center align-items-center desktop-main"
        style="height: 100vh; pointer-events: none;">
        <!-- Central Diamond Button -->
        <div class="central-button-container" style="pointer-events: auto;">
            <div class="diamond-menu-area">
                <!-- Hidden Menu Buttons -->
                <a href="#" class="menu-btn btn-top" id="administrasi-pemerintah">
                    <img src="{{ asset('web-assets/assets/img/ADM Pemerintah Button 1.png') }}" alt="ADM Pemerintah"
                        class="img-fluid">
                </a>
                <a href="#" class="menu-btn btn-left" id="layanan-publik">
                    <img src="{{ asset('web-assets/assets/img/Layanan Publik Button 1.png') }}" alt="Layanan Publik"
                        class="img-fluid">
                </a>
                <a href="{{ route('web.mall-data-informasi') }}" class="menu-btn btn-right">
                    <img src="{{ asset('web-assets/assets/img/Mall Data dan Informasi Button 1.png') }}"
                        alt="Mall Data dan Informasi" class="img-fluid">
                </a>

                <!-- Main Central Button -->
                <a href="#" class="btn-main-diamond d-block text-decoration-none">
                    <img src="{{ asset('web-assets/assets/img/Main Button Flat 1.png') }}" alt="Nunukan Satu"
                        class="img-fluid main-logo-img">
                </a>
            </div>
        </div>
    </main>

    <!-- Mobile Main Content -->
    <main class="mobile-main" style="display: none;">
        <div class="mobile-services-container">
            <!-- Layanan Publik Button -->
            <button class="mobile-service-btn btn-layanan-publik" id="layanan-publik-mobile" type="button">
                <span>LAYANAN PUBLIK</span>
            </button>

            <!-- Layanan Administrasi Pemerintah Button -->
            <button class="mobile-service-btn btn-adm-pemerintah-mobile" id="adm-pemerintah-mobile" type="button">
                <span>LAYANAN ADMINISTRASI PEMERINTAH</span>
            </button>

            <!-- Mall Data & Informasi Button -->
            <button class="mobile-service-btn btn-mall-data-mobile" id="mall-data-mobile" type="button" data-route="{{ route('web.mall-data-informasi') }}">
                <span>MALL DATA & INFORMASI</span>
            </button>
        </div>

        <!-- Apps Grid Carousel -->
        <div class="mobile-apps-section">
            <div class="mobile-apps-container" id="mobileAppsContainer">
                <!-- Row 1 -->
                <div class="mobile-apps-row">
                    <!-- e-Presence -->
                    <div class="mobile-app-card">
                        <div class="mobile-app-icon">
                            <a href="@if(session('sso_data')){{ route('web.adm-services') }}?url={{ urlencode('https://ekinerja.nunukankab.go.id/presence/sso.php') }}&name={{ urlencode('E-PRESENCE') }}@else{{ route('web.sso-login') }}@endif"
                                class="mobile-app-link" 
                                data-app-target="https://ekinerja.nunukankab.go.id/presence/sso.php" 
                                data-app-type="epresence"
                                title="E-PRESENCE">
                                <img src="{{ asset('web-assets/assets/img/epresence.png') }}" alt="e-Presence">
                            </a>
                        </div>
                        <p class="mobile-app-label">e-Presence</p>
                    </div>

                    <!-- FMIS -->
                    <div class="mobile-app-card">
                        <div class="mobile-app-icon">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://nunukankab.fmis.id/2023/') }}&name={{ urlencode('FMIS') }}">
                                <img src="{{ asset('web-assets/assets/img/fmis.png') }}" alt="FMIS">
                            </a>
                        </div>
                        <p class="mobile-app-label">FMIS</p>
                    </div>

                    <!-- BKN -->
                    <div class="mobile-app-card">
                        <div class="mobile-app-icon">
                            <a href="https://asndigital.bkn.go.id/" target="_blank">
                                <img src="{{ asset('web-assets/assets/img/bkn.png') }}" alt="BKN">
                            </a>
                        </div>
                        <p class="mobile-app-label">BKN</p>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="mobile-apps-row">
                    <!-- ANJAB -->
                    <div class="mobile-app-card">
                        <div class="mobile-app-icon">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://eanjab.nunukankab.go.id/sso.php') }}&name={{ urlencode('ANJAB') }}">
                                <img src="{{ asset('web-assets/assets/img/eanjab.png') }}" alt="ANJAB">
                            </a>
                        </div>
                        <p class="mobile-app-label">ANJAB</p>
                    </div>

                    <!-- SIRAPEL -->
                    <div class="mobile-app-card">
                        <div class="mobile-app-icon">
                            <a href="@if(session('sso_data')){{ route('web.adm-services') }}?url={{ urlencode('https://sirapel.nunukankab.go.id/sso') }}&name={{ urlencode('SIRAPEL') }}@else{{ route('web.sso-login') }}@endif"
                                class="mobile-app-link"
                                data-app-target="https://sirapel.nunukankab.go.id/sso"
                                data-app-type="iframe"
                                title="SIRAPEL">
                                <img src="{{ asset('web-assets/assets/img/sirapel.png') }}" alt="SIRAPEL">
                            </a>
                        </div>
                        <p class="mobile-app-label">SIRAPEL</p>
                    </div>

                    <!-- SIPAKRT -->
                    <div class="mobile-app-card">
                        <div class="mobile-app-icon">
                            <a href="{{ route('web.public-services', ['name' => 'SIPAKRT', 'url' => 'https://sipakrt.nunukankab.go.id/']) }}">
                                <img src="{{ asset('web-assets/assets/img/icon-sipakrt.png') }}" alt="SIPAKRT">
                            </a>
                        </div>
                        <p class="mobile-app-label">SIPAKRT</p>
                    </div>
                </div>
            </div>

            <!-- Pagination Dots
            <div class="mobile-apps-pagination">
                <span class="dot active" data-page="0"></span>
                <span class="dot" data-page="1"></span>
            </div> -->
        </div>
    </main>

    <!-- Footer -->
    <footer class="fixed-bottom bg-white py-3 border-top">
        <div class="container-fluid px-5 d-flex justify-content-between align-items-center">
            <!-- Left: Logo/Icon -->
            <div class="d-flex align-items-center gap-2 footer-logo-section">
                <img src="{{ asset('web-assets/assets/img/Footer 3.png') }}" alt="Nunukan Satu Footer Logo" height="40">
                <img src="{{ asset('web-assets/assets/img/Nunukansatu Logo1 2.png') }}" alt="Nunukan Satu Logo"
                    height="40">
            </div>

            <!-- Center: Copyright -->
            <div class="text-center">
                <small class="fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">&copy; 2026
                    PEMERINTAH KABUPATEN NUNUKAN. ALL RIGHTS RESERVED.</small>
            </div>

            <!-- Right: Pengaduan Button -->
            <div class="d-flex">
                <button class="btn btn-outline-danger px-4 py-1 d-flex align-items-center gap-2"
                    style="border-radius: 10px;">
                    <i class="bi bi-chevron-up"></i>
                    <span>Pengaduan</span>
                </button>
                <img src="{{ asset('web-assets/assets/img/Footer 2.png') }}" alt="Nunukan Satu Footer Logo" height="40">
            </div>
        </div>
    </footer>

    <!-- Floating Live Chat Button -->
    <div class="position-fixed bottom-0 end-0 m-4 mb-5 pb-4" style="z-index: 1050;">
        <button id="liveChatBtn"
            class="btn btn-primary-red rounded-circle shadow-lg d-flex align-items-center justify-content-center"
            style="width: 60px; height: 60px;">
            <i class="bi bi-headset fs-3"></i>
        </button>
    </div>

    @if($announcement)
        @include('web.components.modal.announcement', ['announcement' => $announcement])
    @endif

    <!-- Live Chat Modal -->
    <div id="liveChatModal" class="modal-overlay live-chat-modal-overlay">
        <div class="modal-content live-chat-modal-content">
            <!-- Header with Logo -->
            <div class="live-chat-header">
                <div class="live-chat-logo-container">
                    <img src="{{ asset('web-assets/assets/img/Nunukansatu Logo1 2.png') }}" alt="Nunukan Satu"
                        class="live-chat-logo">
                </div>
            </div>

            <!-- Content Area -->
            <div class="live-chat-body">
                <!-- Greeting Message -->
                <div class="live-chat-greeting">
                    <h3>Hai</h3>
                    <p>Bagaimana kami dapat membantu?</p>
                </div>

                <!-- Form Fields -->
                <form id="liveChatForm" class="live-chat-form">
                    <!-- Email Field -->
                    <div class="live-chat-field">
                        <label for="chatEmail" class="live-chat-label">Email</label>
                        <input type="email" id="chatEmail" class="live-chat-input"
                            placeholder="Masukkan alamat email Anda" required>
                    </div>

                    <!-- Name Field -->
                    <div class="live-chat-field">
                        <label for="chatName" class="live-chat-label">Nama</label>
                        <input type="text" id="chatName" class="live-chat-input"
                            placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <!-- Message Field -->
                    <div class="live-chat-field live-chat-field-large">
                        <label for="chatMessage" class="live-chat-label">Pesan</label>
                        <textarea id="chatMessage" class="live-chat-textarea" placeholder="Masukkan pesan Anda"
                            required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="live-chat-submit-btn">
                        Start Conversation
                    </button>
                </form>
            </div>

            <!-- Close Button -->
            <button class="close-modal btn btn-sm btn-danger live-chat-close"
                style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Layanan Publik Modal -->
    <div id="publicModal" class="modal-overlay">
        <div class="modal-content modal-public-services">
            <div class="modal-header-public">
                <div class="header-title-section">
                    <h2>LAYANAN PUBLIK</h2>
                    <div class="header-underline"></div>
                </div>
                <button class="close-modal btn btn-sm btn-danger px-3">
                    <i class="bi bi-x"></i>
                    <span>Tutup</span>
                </button>
            </div>
            <div class="modal-body-public">
                {{-- User Info Section - Tampil ketika sudah login SSO --}}
                @if (session('sso_data'))
                    @php $pubSsoArr = json_decode(session('sso_data'), true); @endphp
                    <div class="pub-user-info-section" style="background: var(--primary-red); padding: 20px 25px; margin: 0 0 20px 0; border-radius: 0 0 0 0; color: white;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="flex: 1;">
                                <div style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 5px;">Masuk sebagai</div>
                                <div style="font-size: 1.2rem; font-weight: 600; margin-bottom: 5px;">
                                    {{ $pubSsoArr['name'] ?? ($pubSsoArr['jabatan'] ?? 'User') }}
                                </div>
                                <div style="font-size: 0.9rem; opacity: 0.9;">
                                    {{ $pubSsoArr['jabatan'] ?? 'Pengguna Publik' }}
                                </div>
                            </div>
                            <button id="btnLogoutPublic" class="btn btn-sm btn-light" style="margin-left: 15px;">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </button>
                        </div>
                    </div>
                    
                    {{-- Store SSO data in localStorage --}}
                    <script type="text/javascript">
                        if (typeof localStorage !== 'undefined') {
                            localStorage.setItem('pubAccessToken', '{{ $pubSsoArr['access_token'] ?? '' }}');
                            localStorage.setItem('pubJabatan', '{{ $pubSsoArr['jabatan'] ?? 'Pengguna Publik' }}');
                            localStorage.setItem('pubUserName', '{{ $pubSsoArr['name'] ?? ($pubSsoArr['jabatan'] ?? 'User') }}');
                        }
                    </script>
                @endif

                <div class="service-grid-new">
                    <!-- Row 1 -->
                    <!-- Card 1: Layanan Pengaduan -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Pengaduan" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Pengaduan</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="https://lapor.go.id/" target="_blank" 
                                    class="service-btn" 
                                    title="LAPOR!">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-lapor.png') }}" alt="LAPOR!">
                                    </span>
                                    <span class="btn-text">LAPOR!</span>
                                </a>
                                <a href="{{ route('web.public-services', ['name' => 'SILAPDAT', 'url' => 'https://satpolpp.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="SILAPDAT">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-silapdat.png') }}"
                                            alt="SILAPDAT">
                                    </span>
                                    <span class="btn-text">SILAPDAT</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Layanan Hukum -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Hukum" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Hukum</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="{{ route('web.public-services', ['name' => 'JDIH', 'url' => 'https://jdih.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="JDIH">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-jdih.png') }}" alt="JDIH">
                                    </span>
                                    <span class="btn-text">JDIH</span>
                                </a>
                                <a href="{{ route('web.public-services', ['name' => 'JDIH Setwan', 'url' => 'https://jdihsetwan.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="JDIH Setwan">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-jdih.png') }}" alt="JDIH">
                                    </span>
                                    <span class="btn-text">JDIH Setwan</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Layanan Sektor Pendidikan -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Sektor Pendidikan" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Sektor<br>Pendidikan</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="https://dapo.kemendikdasmen.go.id/" target="_blank" 
                                    class="service-btn" 
                                    title="DAPODIK">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-dapodik.png') }}" alt="DAPODIK">
                                    </span>
                                    <span class="btn-text">DAPODIK</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Layanan Geospasial -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Geospasial" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Geospasial</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="{{ route('web.public-services', ['name' => 'GIS KAB. NUNUKAN', 'url' => 'https://gis.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="GIS KAB. NUNUKAN">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-gis-nunukan.png') }}"
                                            alt="GIS Kabupaten Nunukan">
                                    </span>
                                    <span class="btn-text">GIS KAB. NUNUKAN</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <!-- Card 5: Layanan Informasi & Dokumentasi -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Informasi & Dokumentasi" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Informasi<br>& Dokumentasi</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="{{ route('web.public-services', ['name' => 'PPID', 'url' => 'http://ppid.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="PPID">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-ppid.png') }}" alt="PPID">
                                    </span>
                                    <span class="btn-text">PPID</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Layanan Kependudukan -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Kependudukan" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Kependudukan</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="{{ route('web.public-services', ['name' => 'SIPAKRT', 'url' => 'https://sipakrt.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="SIPAKRT">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-sipakrt.png') }}" alt="SIPAKRT">
                                    </span>
                                    <span class="btn-text">SIPAKRT</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 7: Layanan Pajak Retribusi -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Pajak Retribusi" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Pajak<br>Retribusi</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="https://pendapatan-nnk.id/" target="_blank" 
                                    class="service-btn" 
                                    title="BTH">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-bth.png') }}" alt="BTH">
                                    </span>
                                    <span class="btn-text">BTH</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 8: Layanan Berusaha -->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Berusaha" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Berusaha</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="{{ route('web.public-services', ['name' => 'OSS', 'url' => 'https://oss.go.id/']) }}" 
                                    class="service-btn" 
                                    title="OSS">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-oss.png') }}" alt="OSS">
                                    </span>
                                    <span class="btn-text">OSS</span>
                                </a>
                                <a href="{{ route('web.public-services', ['name' => 'SEMPADAN', 'url' => 'https://sempadan.nunukankab.go.id/']) }}" 
                                    class="service-btn" 
                                    title="SEMPADAN">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-sempadan.png') }}"
                                            alt="SEMPADAN">
                                    </span>
                                    <span class="btn-text">SEMPADAN</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Card 9: Layanan Kesehatan-->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Kesehatan" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Kesehatan</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="https://sehati.nunukankab.go.id/" target="_blank"
                                    class="service-btn" 
                                    title="SEHATI">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-ppid.png') }}" alt="PPID">
                                    </span>
                                    <span class="btn-text">SEHATI</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 10: Layanan Pengadaan Barang dan Jasa-->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Kesehatan" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Pengadaan Barang <br>dan Jasa</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="https://spse.inaproc.id/nunukankab" target="_blank" 
                                    class="service-btn" 
                                    title="INAPROC">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-ppid.png') }}" alt="PPID">
                                    </span>
                                    <span class="btn-text">INAPROC</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 11: Layanan Pengadaan Barang dan Jasa-->
                    <div class="service-card-new">
                        <div class="card-image-section">
                            <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                                alt="Layanan Kesehatan" class="card-bg-image">
                            <div class="card-overlay"></div>
                            <h3 class="card-title">Layanan Perpustakaan</h3>
                        </div>
                        <div class="card-content-section">
                            <div class="service-btn-group">
                                <a href="http://layananperpus.nunukankab.go.id" target="_blank" 
                                    class="service-btn" 
                                    title="INLISLITE">
                                    <span class="btn-icon">
                                        <img src="{{ asset('web-assets/assets/img/icon-ppid.png') }}" alt="PPID">
                                    </span>
                                    <span class="btn-text">INLISLITE</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADM Pemerintah Modal - Layanan Administrasi Pemerintah -->
    <div id="admModal" class="modal-overlay" aria-hidden="true">
        @if (session('sso_data'))
            <!-- SSO Data for JavaScript -->
            <script type="application/json" id="admSsoData">{!! session('sso_data') !!}</script>
            
            <!-- Jika sudah login dari SSO, tampilkan services modal -->
            @include('web.components.modal.modal-adm-services')
        @else
            <div class="modal-content adm-modal-content">
                <button class="close-modal btn btn-sm btn-danger"
                    style="position: absolute; top: 15px; right: 15px; z-index: 10;">
                    <i class="bi bi-x"></i>
                    <span class="close-modal-label">Keluar</span>
                </button>
                <div class="adm-modal-wrapper">
                    <!-- Left Side: Logo & Login Options -->
                    <div class="adm-left-panel">
                        <div class="adm-login-options">
                            <div class="adm-logo-container">
                                <img src="{{ asset('web-assets/assets/img/nunukan-1.png') }}" alt="Nunukan Satu Logo"
                                    class="adm-logo-img">
                            </div>
                            <a href="{{ route('web.sso-login') }}" class="adm-btn-login adm-btn-myasn">
                                <svg class="adm-btn-icon" viewBox="0 0 24 24" width="24" height="24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"
                                        fill="white" />
                                </svg>
                                <span>Masuk Dengan MyAsn</span>
                            </a>
                            <a href="https://mail.nunukankab.go.id/webmail/" class="adm-btn-login adm-btn-email"
                                target="_blank">
                                <svg class="adm-btn-icon" viewBox="0 0 24 24" width="24" height="24">
                                    <path
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"
                                        fill="#D32F2F" />
                                </svg>
                                <span>Mail Dinas @nunukankab.go.id</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Side: Services List -->
                    <div class="adm-right-panel">
                        <!-- Layanan Naskah Dinas & Kesehatan -->
                        <div class="adm-service-section">
                            <div class="adm-service-row">
                                <div class="adm-service-label">
                                    <p>Layanan naskah dinas<br>dan kesehatan</p>
                                </div>
                                <div class="adm-service-icons">
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/tndd.png') }}" alt="TNDD"></div>
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/srikandi.png') }}" alt="SRIKANDI"></div>
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/sirapel.png') }}" alt="SIRAPEL"></div>
                                </div>
                            </div>
                            <div class="adm-divider"></div>
                        </div>

                        <!-- Layanan Manajemen Kepegawaian -->
                        <div class="adm-service-section">
                            <div class="adm-service-row">
                                <div class="adm-service-label">
                                    <p>Layanan Manajemen<br>Kepegawaian</p>
                                </div>
                                <div class="adm-service-icons">
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/bkn.png') }}" alt="BKN"></div>
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/eanjab.png') }}" alt="eANJAB"></div>
                                </div>
                            </div>
                            <div class="adm-divider"></div>
                        </div>

                        <!-- Layanan Manajemen Perencanaan & Anggaran -->
                        <div class="adm-service-section">
                            <div class="adm-service-row">
                                <div class="adm-service-label">
                                    <p>Layanan Manajemen<br>Perencanaan dan Anggaran</p>
                                </div>
                                <div class="adm-service-icons">
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/sipecel.png') }}" alt="SIPECEL"></div>
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/sipd.png') }}" alt="SIPD"></div>
                                </div>
                            </div>
                            <div class="adm-divider"></div>
                        </div>

                        <!-- Layanan Manajemen Keuangan -->
                        <div class="adm-service-section">
                            <div class="adm-service-row">
                                <div class="adm-service-label">
                                    <p>Layanan Manajemen<br>Keuangan</p>
                                </div>
                                <div class="adm-service-icons">
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/fmis.png') }}" alt="FMIS"></div>
                                </div>
                            </div>
                            <div class="adm-divider"></div>
                        </div>

                        <!-- Layanan Manajemen Kinerja -->
                        <div class="adm-service-section">
                            <div class="adm-service-row">
                                <div class="adm-service-label">
                                    <p>Layanan Manajemen<br>Kinerja</p>
                                </div>
                                <div class="adm-service-icons">
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/epresence.png') }}" alt="e-Presence"></div>
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/simanja.png') }}" alt="SIMANJA"></div>
                                    <div class="adm-icon-item"><img src="{{ asset('web-assets/assets/img/sepakat.png') }}" alt="SEPAKAT"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Coming Soon -->
                        <div class="adm-coming-soon">
                            <h5>Coming Soon:</h5>
                            <div class="adm-upcoming-items">
                                <div class="adm-upcoming-item">
                                    <img src="{{ asset('web-assets/assets/img/tndd.png') }}" alt="TNDD">
                                    <p>Fitur Surat Perintah Perjalanan Dinas</p>
                                </div>
                                <div class="adm-upcoming-item">
                                    <img src="{{ asset('web-assets/assets/img/sirapel.png') }}" alt="SIRAPEL">
                                    <p>Fitur Notulensi Full Record</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Fallback detection untuk persistent SSO session -->
            <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                // Check if user was previously logged in via SSO (stored in localStorage)
                const admAccessToken = localStorage.getItem('admAccessToken');
                const admJabatan = localStorage.getItem('admJabatan');
                
                if (admAccessToken && admJabatan) {
                    console.log('✓ SSO session detected from localStorage after reload');
                    console.log('  - Jabatan:', admJabatan);
                    console.log('  - Access Token:', admAccessToken.substring(0, 20) + '...');
                    
                    // Refresh page to restore session from server
                    // This allows server to refresh the session in memory
                    const currentUrl = window.location.href;
                    if (!currentUrl.includes('from_refresh=1')) {
                        console.log('📄 Refreshing page to restore server session...');
                        const separator = currentUrl.includes('?') ? '&' : '?';
                        window.location.href = currentUrl + separator + 'from_refresh=1';
                    }
                }
            });
            </script>
        @endif
    </div>

    <!-- Pengaduan Popup -->
    <div id="pengaduanPopup" class="pengaduan-popup">
        <div class="pengaduan-options">
            <div class="pengaduan-option">
                <h6 class="option-title">
                    <a href="https://lapor.go.id" target="_blank">SP4N Lapor</a>
                </h6>
            </div>
            <div class="pengaduan-option">
                <h6 class="option-title">
                    <a href="https://satpolpp.nunukankab.go.id/" target="_blank">SILAPDAT</a>
                </h6>
            </div>
            <div class="pengaduan-option">
                <h6 class="option-title">
                    <a href="https://wbs.nunukankab.go.id/" target="_blank">WBS</a>
                </h6>
            </div>
            <div class="pengaduan-option">
                <h6 class="option-title">
                    <a href="https://forms.zohopublic.com/inspektoratnunukan1/form/PELAYANANKONSULTASI/formperma/zRe1jeiELo69ESPH80F4dfanVC72mD6XQS7BuBkNFY4"
                        target="_blank">Pelayanan Konsultasi</a>
                </h6>
            </div>
        </div>
    </div>

    <!-- Search Results Modal -->
    <div id="searchModal" class="modal-overlay search-modal-overlay">
        <div class="modal-content search-modal-content">
            <!-- Search Header with Input -->
            <div class="search-header">
                <input type="text" id="searchInput" class="search-input"
                    placeholder="Cari layanan, berita, atau informasi...">
                <button class="close-modal btn btn-sm btn-danger px-3" id="closeSearchModal">
                    <i class="bi bi-x"></i>
                    <span>Keluar</span>
                </button>
            </div>

            <!-- Tab Navigation -->
            <div class="search-tabs">
                <button class="search-tab active" data-tab="all">
                    <span class="tab-icon">
                        <i class="bi bi-list"></i>
                    </span>
                    <span class="tab-label">Semua</span>
                    <span class="tab-count">0</span>
                </button>
                <button class="search-tab" data-tab="publik">
                    <span class="tab-icon">
                        <i class="bi bi-info-circle"></i>
                    </span>
                    <span class="tab-label">Layanan Publik</span>
                    <span class="tab-count">0</span>
                </button>
                <button class="search-tab" data-tab="adm">
                    <span class="tab-icon">
                        <i class="bi bi-building"></i>
                    </span>
                    <span class="tab-label">Layanan ADM Pemerintah</span>
                    <span class="tab-count">0</span>
                </button>
                <button class="search-tab" data-tab="berita">
                    <span class="tab-icon">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    <span class="tab-label">Berita</span>
                    <span class="tab-count">0</span>
                </button>
                <button class="search-tab" data-tab="data-informasi">
                    <span class="tab-icon">
                        <i class="bi bi-database"></i>
                    </span>
                    <span class="tab-label">Data & Informasi</span>
                    <span class="tab-count">0</span>
                </button>
            </div>

            <!-- Search Results Content -->
            <div class="search-results-body">
                <!-- Tab: Semua -->
                <div class="search-tab-content active" id="tab-all">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Tab: Layanan Publik -->
                <div class="search-tab-content" id="tab-publik">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Tab: Layanan ADM Pemerintah -->
                <div class="search-tab-content" id="tab-adm">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Tab: Berita -->
                <div class="search-tab-content" id="tab-berita">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Tab: Data & Informasi -->
                <div class="search-tab-content" id="tab-data-informasi">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Top Apps Section -->
    <section class="top-apps-section fixed-bottom" style="bottom: 80px; width: 100%; z-index: 100; padding: 20px 0;">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="top-apps-container" style="display: flex; gap: 5px; overflow-x: auto; padding: 0 20px; scroll-behavior: smooth;">
                    
                    <!-- Top App 1: LAPOR -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            LAPOR
                        </div>
                        <a href="https://lapor.go.id/" target="_blank" class="top-app-btn" title="LAPOR"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/icon-lapor.png') }}" alt="LAPOR" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Top App 2: OPD -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            OPD
                        </div>
                        <a href="{{ route('web.public-services', ['name' => 'OPD', 'url' => 'https://nunukankab.go.id/mall-data/beranda']) }}" class="top-app-btn" title="OPD"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/nunukan-icon.png') }}" alt="OPD" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Top App 3: JDIH -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            JDIH
                        </div>
                        <a href="{{ route('web.public-services', ['name' => 'JDIH', 'url' => 'https://jdih.nunukankab.go.id/']) }}" class="top-app-btn" title="JDIH"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/icon-jdih.png') }}" alt="JDIH" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Top App 4: BKN -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            BKN
                        </div>
                        <a href="@if(session('sso_data')){{ route('web.adm-services') }}?url={{ urlencode('https://asndigital.bkn.go.id/') }}&name={{ urlencode('BKN') }}@else{{ route('web.sso-login') }}@endif" class="top-app-btn" title="BKN"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/bkn.png') }}" alt="BKN" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Top App 5: SIMANJA -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            SIMANJA
                        </div>
                        <a href="@if(session('sso_data')){{ route('web.adm-services') }}?url={{ urlencode('https://ekinerja.nunukankab.go.id/login/sso.php') }}&name={{ urlencode('SIMANJA') }}@else{{ route('web.sso-login') }}@endif" class="top-app-btn" title="SiManja"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/simanja.png') }}" alt="SiManja" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Top App 6: SEPAKAT -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            SEPAKAT
                        </div>
                        <a href="@if(session('sso_data')){{ route('web.adm-services') }}?url={{ urlencode('https://sepakat.nunukankab.go.id/auth/sso') }}&name={{ urlencode('SEPAKAT') }}@else{{ route('web.sso-login') }}@endif" class="top-app-btn" title="SEPAKAT"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/sepakat.png') }}" alt="SEPAKAT" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Top App 7: LHKPN -->
                    <div class="top-app-item" style="display: flex; flex-direction: column; align-items: center; min-width: 70px; width: 70px;">
                        <div class="top-app-label" style="background: #D32F2F; color: white; padding: 4px 20px; border-radius: 24px; font-weight: bold; font-size: 14px; margin-bottom: 8px; opacity: 0; transition: opacity 0.3s ease;">
                            LHKPN
                        </div>
                        <a href="https://kab-nunukan.atrbpn.go.id/" target="_blank" rel="noopener noreferrer" class="top-app-btn" title="LHKPN"
                            style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                            <img src="{{ asset('web-assets/assets/img/icon-lkhpn.png') }}" alt="LHKPN" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Services Modal - Kategori Layanan -->
    @include('web.components.modal.modal-services')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web-assets/script.js') }}"></script>
    <script src="{{ asset('web-assets/search.js') }}"></script>

    <script>
        // Handle service button clicks - open external links in new tab
        document.addEventListener('DOMContentLoaded', function() {
            const pengumumanJptModal = document.getElementById('pengumumanJptModal');
            if (pengumumanJptModal) {
                const closePengumumanJpt = function () {
                    pengumumanJptModal.classList.remove('show');
                    setTimeout(function () {
                        pengumumanJptModal.style.display = 'none';
                    }, 300);
                };

                pengumumanJptModal.style.display = 'flex';
                setTimeout(function () {
                    pengumumanJptModal.classList.add('show');
                }, 10);

                const pengumumanCloseBtn = pengumumanJptModal.querySelector('.close-modal');
                if (pengumumanCloseBtn) {
                    pengumumanCloseBtn.addEventListener('click', closePengumumanJpt);
                }

                pengumumanJptModal.addEventListener('click', function (e) {
                    if (e.target === pengumumanJptModal) {
                        closePengumumanJpt();
                    }
                });
            }

            // Top Apps Label Hover Effect
            const topAppItems = document.querySelectorAll('.top-app-item');
            topAppItems.forEach(item => {
                const btn = item.querySelector('.top-app-btn');
                const label = item.querySelector('.top-app-label');
                
                btn.addEventListener('mouseenter', function() {
                    label.style.opacity = '1';
                });
                
                btn.addEventListener('mouseleave', function() {
                    label.style.opacity = '0';
                });
            });

            const serviceButtons = document.querySelectorAll('.service-btn, .adm-app-link');
            
            serviceButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    const dataAppTarget = this.getAttribute('data-app-target');
                    const link = href || dataAppTarget;
                    const title = this.getAttribute('title') || 'Service';
                    const appType = this.getAttribute('data-app-type');
                    
                    // Skip if no valid link
                    if (!link) return;
                    
                    // Check if link is external (not on nunukankab.go.id domain)
                    const isExternal = !link.includes('nunukankab.go.id') && 
                                      (link.startsWith('http://') || link.startsWith('https://'));
                    
                    console.log(`🔗 Service clicked: ${title}`);
                    console.log(`   Link: ${link}`);
                    console.log(`   Type: ${appType || 'default'}`);
                    console.log(`   External: ${isExternal}`);
                    
                    if (isExternal) {
                        // External link - open in new tab instead of iframe
                        e.preventDefault();
                        console.log(`🌐 External link detected - opening in new tab`);
                        window.open(link, '_blank');
                        return;
                    }
                    
                    // For internal links, proceed with default behavior
                    // If it's an href link without preventDefault, browser will navigate normally
                    // If it needs to be handled specially, that's done elsewhere
                });
            });

            // Setup Mobile App Links Handlers (e-Presence, SIRAPEL, etc.)
            const mobileAppLinks = document.querySelectorAll('.mobile-app-link');
            const admAccessToken = localStorage.getItem('admAccessToken');
            
            mobileAppLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const appType = this.getAttribute('data-app-type');
                    const appTarget = this.getAttribute('data-app-target');
                    const appName = this.getAttribute('title') || 'Service';
                    
                    console.log(`📱 Mobile app clicked: ${appName} (Type: ${appType})`);
                    console.log(`  - Target: ${appTarget}`);
                    console.log(`  - Access Token: ${admAccessToken ? 'Available' : 'Not Found'}`);
                    
                    // If not logged in, let default href handle the redirect to login
                    if (!admAccessToken) {
                        console.log(`🔐 Not logged in - using default redirect to login`);
                        return;
                    }
                    
                    // If logged in, apply proper app type handling
                    if (appType === 'epresence') {
                        // E-Presence - open in new tab with access token
                        e.preventDefault();
                        let openUrl = appTarget.includes('?')
                            ? appTarget + '&access_token=' + admAccessToken
                            : appTarget + '?access_token=' + admAccessToken;
                        console.log(`🌐 Opening EPRESENCE in new tab with token`);
                        window.open(openUrl, '_blank');
                    } 
                    else if (appType === 'iframe') {
                        // Iframe - navigate to adm-services page
                        e.preventDefault();
                        const encodedUrl = encodeURIComponent(appTarget);
                        const encodedName = encodeURIComponent(appName);
                        const servicePageUrl = '{{ route("web.adm-services") }}?url=' + encodedUrl + '&name=' + encodedName;
                        console.log(`📄 Navigating to iframe service page`);
                        window.location.href = servicePageUrl;
                    }
                });
            });
        });
    </script>

    <!-- Stack for component scripts -->
    @stack('scripts')
</body>

</html>
