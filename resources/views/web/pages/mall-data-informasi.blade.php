<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mall Data & Informasi - Nunukan Satu</title>
    <link rel="icon" href="{{ asset('assets/favnunukan.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Preconnect ke domain iframe eksternal agar koneksi lebih cepat -->
    <link rel="dns-prefetch" href="https://profil.nunukankab.go.id">
    <link rel="dns-prefetch" href="https://satudata.nunukankab.go.id">
    <link rel="dns-prefetch" href="https://berita.nunukankab.go.id">
    <link rel="dns-prefetch" href="https://jdih.nunukankab.go.id">
    <link rel="dns-prefetch" href="https://transparansianggaran.nunukankab.go.id">
    <link rel="dns-prefetch" href="https://proyekstrategisdaerah.nunukankab.go.id">
    <link rel="dns-prefetch" href="https://lookerstudio.google.com">
    <link rel="preconnect" href="https://profil.nunukankab.go.id" crossorigin>
    <link rel="preconnect" href="https://satudata.nunukankab.go.id" crossorigin>
    <link rel="preconnect" href="https://berita.nunukankab.go.id" crossorigin>
    <link rel="preconnect" href="https://jdih.nunukankab.go.id" crossorigin>
    <link rel="preconnect" href="https://transparansianggaran.nunukankab.go.id" crossorigin>
    <link rel="preconnect" href="https://proyekstrategisdaerah.nunukankab.go.id" crossorigin>
    <link rel="preconnect" href="https://lookerstudio.google.com" crossorigin>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('web-assets/style.css') }}">
    <!-- Public Services CSS for Search Modal -->
    <link rel="stylesheet" href="{{ asset('web-assets/public-services.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: #212121;
        }

        /* Header/Navbar */
        .mall-header {
            background-color: #D32F2F;
            padding: 12px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .mall-logo {
            height: 50px;
        }

        .mall-nav {
            display: flex;
            align-items: center;
            gap: 32px;
            flex: 1;
            margin-left: 40px;
        }

        .mall-nav a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            padding-bottom: 4px;
            transition: all 0.3s ease;
        }

        .mall-nav a:after {
            content: '▼';
            font-size: 8px;
            margin-left: 4px;
        }

        .mall-nav a:hover {
            opacity: 0.8;
        }

        .mall-search-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
        }

        /* Main Content Area */
        .mall-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #D32F2F 0%, #8E0000 100%);
            padding: 60px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mall-cards-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            max-width: 1200px;
            width: 100%;
        }

        .mall-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .mall-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
        }

        .mall-card-image {
            width: 100%;
            height: 280px;
            overflow: hidden;
            position: relative;
        }

        .mall-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mall-card-title {
            padding: 24px;
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            color: #212121;
        }

        .mall-card-pattern {
            width: 100%;
            height: 80px;
            background: repeating-linear-gradient(45deg,
                    #f5f5f5,
                    #f5f5f5 10px,
                    #eeeeee 10px,
                    #eeeeee 20px);
            opacity: 0.5;
        }

        /* Bottom Navigation */
        .mall-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 3px solid #D32F2F;
            padding: 16px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
            height: 100px;
        }

        .mall-logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mall-logo-section img {
            height: 40px;
        }

        .mall-logo-text {
            font-size: 12px;
            font-weight: 600;
            color: #212121;
        }

        .mall-nav-center {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            justify-content: center;
            min-width: 0;
            margin: 0 60px;
        }

        .mall-nav-items {
            display: flex;
            align-items: center;
            gap: 12px;
            overflow-x: auto;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
            padding: 4px 0;
            width: 100%;
        }

        .mall-nav-items::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari and Opera */
        }

        .mall-search-box {
            background: #D8423F;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            width: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .mall-search-box:hover {
            background: #B71C1C;
        }

        .mall-search-box i {
            font-size: 14px;
        }

        .mall-search-box span {
            font-size: 12px;
            font-weight: 500;
            color: white;
        }

        .mall-arrow-btn {
            background: white;
            border: 2px solid #D8423F;
            color: #D8423F;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease, color 0.3s ease;
            flex-shrink: 0;
            font-size: 18px;
        }

        .mall-arrow-btn:hover {
            background: #D8423F;
            color: white;
        }

        .mall-action-btn {
            background: #D8423F;
            border: none;
            color: white;
            padding: 8px 16px 8px 8px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
            min-width: 240px;
        }

        .mall-action-btn.active {
            background: #A6160F;
        }

        .mall-action-btn:hover {
            background: #A6160F;
        }

        .mall-action-btn .icon-circle {
            background: white;
            color: #D8423F;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .mall-action-btn.active .icon-circle {
            color: #A6160F;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .mall-cards-wrapper {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 768px) {
            .mall-header {
                padding: 12px 20px;
                flex-wrap: wrap;
            }

            .mall-nav {
                display: none;
            }

            .mall-container {
                padding: 40px 20px;
                padding-bottom: 140px;
            }

            .mall-cards-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .mall-card-image {
                height: 200px;
            }

            .mall-bottom-nav {
                padding: 12px 20px;
                flex-wrap: wrap;
                gap: 12px;
                height: auto;
            }

            .mall-nav-center {
                width: 100%;
                order: 3;
                margin: 0 60px;
            }
        }

        /* Hamburger Menu Button Styles */
        .mall-hamburger-btn {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 24px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-left: 10px;
        }

        .mall-hamburger-btn span {
            width: 100%;
            height: 3px;
            background-color: #D32F2F;
            border-radius: 2px;
            transition: all 0.3s ease;
            display: block;
        }

        .mall-hamburger-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .mall-hamburger-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .mall-hamburger-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        /* Mobile Menu Dropdown */
        .mall-nav-center {
            position: relative;
        }

        .mall-mobile-menu-dropdown {
            position: fixed;
            bottom: 65px;
            right: 16px;
            left: 16px;
            background: white;
            border-top: 3px solid #D32F2F;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.15);
            max-height: 300px;
            overflow-y: auto;
            display: none;
            z-index: 9999;
        }

        .mall-mobile-menu-dropdown.active {
            display: block;
        }

        .mall-mobile-menu-dropdown .mall-action-btn {
            width: 100%;
            margin-bottom: 10px;
            min-width: auto;
        }

        .mall-mobile-menu-dropdown .mall-action-btn:last-child {
            margin-bottom: 0;
        }

        /* Mobile Responsive - Hide scroll buttons on very small screens */
        @media (max-width: 480px) {
            .mall-hamburger-btn {
                display: flex;
                order: 3;
            }

            .mall-bottom-nav {
                padding: 12px 16px;
                height: auto;
            }

            .mall-logo-section {
                order: 1;
            }

            .mall-nav-center {
                width: auto;
                margin: 0;
                order: 2;
                gap: 0;
            }

            .mall-nav-items,
            .mall-arrow-btn,
            .mall-search-box {
                display: none;
            }

            .mall-nav-center {
                position: relative;
            }

            .mall-action-btn .icon-circle {
                background: white;
                color: #D8423F;
                width: 16px;
                height: 16px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
            }
        }

        /* Iframe Container Styles */
        .mall-iframe-container {
            position: relative;
            width: 100%;
            height: calc(100vh - 100px);
        }

        .iframe-section {
            position: absolute;
            inset: 0;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            background: #f5f5f5;
            transition: opacity 0.12s ease;
        }

        .iframe-section.active {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }

        .iframe-section iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .mall-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.25rem solid rgba(211, 47, 47, 0.15);
            border-top-color: #D32F2F;
            border-radius: 50%;
            animation: mall-spin 0.7s linear infinite;
        }

        @keyframes mall-spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .mall-iframe-container {
                height: calc(100vh - 130px);
            }
        }

        /* Coming Soon Section */
        .coming-soon-section {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .coming-soon-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .coming-soon-icon {
            position: relative;
            z-index: 2;
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        @media (max-width: 480px) {
            .coming-soon-section:not(.active) {
                pointer-events: none;
            }
        }

        /* Coming Soon Tooltip */
        .coming-soon-tooltip {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            z-index: 10000;
            text-align: center;
            display: none;
            max-width: 280px;
            border-top: 4px solid #D32F2F;
        }

        .coming-soon-tooltip.active {
            display: block;
        }

        .coming-soon-tooltip-title {
            font-size: 18px;
            font-weight: 600;
            color: #D32F2F;
            margin-bottom: 12px;
        }

        .coming-soon-tooltip-text {
            font-size: 14px;
            color: #212121;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .coming-soon-tooltip-btn {
            background: #D32F2F;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .coming-soon-tooltip-btn:hover {
            background: #A6160F;
        }
    </style>
</head>

<body data-search-path="{{ asset('web-assets/search.json') }}" data-api-search-path="{{ route('api.search-data') }}">
    <div class="mall-iframe-container">
    <div id="profilDaerah" class="iframe-section active">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://profil.nunukankab.go.id/" title="Profil Daerah Nunukan" style="display:none;"></iframe>
    </div>

    <div id="satudata" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://satudata.nunukankab.go.id/" title="Satu Data Nunukan" style="display:none;"></iframe>
    </div>

    <div id="arsitekturSPBE" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://lookerstudio.google.com/embed/reporting/190fae7e-ba33-48f7-8231-9fec9ef1464b/page/X94cD" title="Arsitektur SPBE" style="display:none;"></iframe>
    </div>

    <div id="berita" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://berita.nunukankab.go.id/" title="Berita Nunukan" style="display:none;"></iframe>
    </div>

    <div id="jdih" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://jdih.nunukankab.go.id/" title="JDIH Nunukan" style="display:none;"></iframe>
    </div>

    <div id="transparansiAnggaran" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://transparansianggaran.nunukankab.go.id/" title="Transparansi Anggaran" style="display:none;"></iframe>
    </div>

    <div id="proyekStrategisDaerah" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="https://proyekstrategisdaerah.nunukankab.go.id/" title="Proyek Strategis Daerah" style="display:none;"></iframe>
    </div>

    <div id="layananFaseKehidupan" class="iframe-section">
        <div class="iframe-loader" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5;">
            <div class="mall-spinner" role="status" aria-label="Loading"></div>
        </div>
        <iframe data-src="{{ url('/layanan-fase-kehidupan') }}" title="Layanan Fase Kehidupan" style="display:none;"></iframe>
    </div>

    <!-- Coming Soon Section -->
    <div id="comingSoon" class="coming-soon-section iframe-section">
        <img src="{{ asset('web-assets/assets/img/coming-soon-bg.jpg') }}" class="coming-soon-bg" alt="Coming Soon Background">
        <img src="{{ asset('web-assets/assets/img/coming-soon-icon.png') }}" class="coming-soon-icon" alt="Coming Soon Icon">
    </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="mall-bottom-nav">
        <div class="mall-logo-section">
            <a href="{{ route('web.home') }}">
                <img src="{{ asset('web-assets/assets/img/Nunukansatu Logo1 2.png') }}" alt="Nunukan Satu Logo">
            </a>
        </div>

        <div class="mall-nav-center">
            <button id="searchBtn" class="mall-search-box">
                <i class="bi bi-search"></i>
                <span>Search</span>
            </button>

            <button class="mall-arrow-btn" id="scrollLeftBtn">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="mall-nav-items" id="navItemsContainer">
                <button class="mall-action-btn active" id="btnProfilDaerah" data-section="profilDaerah">
                    <span class="icon-circle">
                        <i class="bi bi-building"></i>
                    </span>
                    Profil Daerah
                </button>

                <button class="mall-action-btn" id="btnSatuData" data-section="satudata">
                    <span class="icon-circle">
                        <i class="bi bi-server"></i>
                    </span>
                    Satu Data
                </button>

                <button class="mall-action-btn" id="btnArsitekturSPBE" data-section="arsitekturSPBE">
                    <span class="icon-circle">
                        <i class="bi bi-bell"></i>
                    </span>
                    Arsitektur SPBE
                </button>

                <button class="mall-action-btn" id="btnPengumuman" data-section="comingSoon">
                    <span class="icon-circle">
                        <i class="bi bi-bell"></i>
                    </span>
                    Pengumuman
                </button>

                <button class="mall-action-btn" id="btnJDIH" data-section="jdih">
                    <span class="icon-circle">
                        <i class="bi bi-database"></i>
                    </span>
                    JDIH
                </button>

                <button class="mall-action-btn" id="btnBerita" data-section="berita">
                    <span class="icon-circle">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    Berita
                </button>

                <button class="mall-action-btn" id="btnProyekStrategisDaerah" data-section="proyekStrategisDaerah">
                    <span class="icon-circle">
                        <i class="bi bi-diagram-3"></i>
                    </span>
                    Proyek Strategis Daerah
                </button>

                <button class="mall-action-btn" id="btnTransparansiAnggaran" data-section="transparansiAnggaran">
                    <span class="icon-circle">
                        <i class="bi bi-cash-coin"></i>
                    </span>
                    Transparansi Anggaran
                </button>

                <button class="mall-action-btn" id="btnLayananFaseKehidupan" data-section="layananFaseKehidupan">
                    <span class="icon-circle">
                        <i class="bi bi-heart-pulse"></i>
                    </span>
                    Layanan Fase Kehidupan
                </button>

                <button class="mall-action-btn" id="btnInformasiADM" data-section="comingSoon">
                    <span class="icon-circle">
                        <i class="bi bi-archive"></i>
                    </span>
                    Informasi ADM Pemerintah
                </button>

                <button class="mall-action-btn" id="btnInformasiPublik" data-section="comingSoon">
                    <span class="icon-circle">
                        <i class="bi bi-bookshelf"></i>
                    </span>
                    Informasi Publik
                </button>
            </div>

            <button class="mall-arrow-btn" id="scrollRightBtn">
                <i class="bi bi-chevron-right"></i>
            </button>

            <!-- Mobile Menu Dropdown -->
            <div class="mall-mobile-menu-dropdown" id="mobileMenuDropdown">
                <button class="mall-action-btn active mobile-menu-item" data-target="btnProfilDaerah">
                    <span class="icon-circle">
                        <i class="bi bi-building"></i>
                    </span>
                    Profil Daerah
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnSatuData">
                    <span class="icon-circle">
                        <i class="bi bi-server"></i>
                    </span>
                    Satu Data
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnArsitekturSPBE">
                    <span class="icon-circle">
                        <i class="bi bi-bell"></i>
                    </span>
                    Arsitektur SPBE
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnPengumuman">
                    <span class="icon-circle">
                        <i class="bi bi-bell"></i>
                    </span>
                    Pengumuman
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnJDIH">
                    <span class="icon-circle">
                        <i class="bi bi-database"></i>
                    </span>
                    JDIH
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnBerita">
                    <span class="icon-circle">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    Berita
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnProyekStrategisDaerah">
                    <span class="icon-circle">
                        <i class="bi bi-diagram-3"></i>
                    </span>
                    Proyek Strategis Daerah
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnTransparansiAnggaran">
                    <span class="icon-circle">
                        <i class="bi bi-cash-coin"></i>
                    </span>
                    Transparansi Anggaran
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnLayananFaseKehidupan">
                    <span class="icon-circle">
                        <i class="bi bi-heart-pulse"></i>
                    </span>
                    Layanan Fase Kehidupan
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnInformasiADM">
                    <span class="icon-circle">
                        <i class="bi bi-archive"></i>
                    </span>
                    Informasi ADM Pemerintah
                </button>

                <button class="mall-action-btn mobile-menu-item" data-target="btnInformasiPublik">
                    <span class="icon-circle">
                        <i class="bi bi-bookshelf"></i>
                    </span>
                    Informasi Publik
                </button>
            </div>
        </div>

        <!-- Hamburger Menu Button (Mobile Only) -->
        <button class="mall-hamburger-btn" id="mobileMenuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div class="mall-mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Coming Soon Tooltip -->
    <div class="coming-soon-tooltip" id="comingSoonTooltip">
        <div class="coming-soon-tooltip-title">
            <i class="bi bi-info-circle" style="margin-right: 8px;"></i>
            Informasi
        </div>
        <div class="coming-soon-tooltip-text">Fitur masih dalam tahap pengembangan</div>
        <button class="coming-soon-tooltip-btn" id="closeComingSoonTooltip">Mengerti</button>
    </div>

    <script src="{{ asset('web-assets/search-modal-component.js') }}"></script>
    <script src="{{ asset('web-assets/search.js') }}"></script>

    <script>
        (function () {
            'use strict';

            const IFRAME_SECTIONS = [
                'profilDaerah',
                'satudata',
                'arsitekturSPBE',
                'berita',
                'jdih',
                'transparansiAnggaran',
                'proyekStrategisDaerah',
                'layananFaseKehidupan'
            ];

            const loadedSections = new Set();
            const loadingSections = new Set();
            let prefetchHoverTimer = null;

            function getSection(sectionId) {
                return document.getElementById(sectionId);
            }

            function isSectionLoaded(sectionId) {
                return loadedSections.has(sectionId);
            }

            function showIframe(section) {
                const iframe = section.querySelector('iframe');
                const loader = section.querySelector('.iframe-loader');
                if (iframe) iframe.style.display = '';
                if (loader) loader.style.display = 'none';
            }

            function loadIframeSection(sectionId, options) {
                const opts = options || {};
                const showLoader = opts.showLoader !== false;

                if (sectionId === 'comingSoon' || isSectionLoaded(sectionId)) {
                    return;
                }

                const section = getSection(sectionId);
                if (!section) return;

                const iframe = section.querySelector('iframe');
                const loader = section.querySelector('.iframe-loader');
                if (!iframe) return;

                const src = iframe.getAttribute('data-src');
                if (!src) return;

                if (iframe.dataset.loading === 'true') {
                    if (showLoader && section.classList.contains('active') && loader) {
                        loader.style.display = 'flex';
                    }
                    return;
                }

                iframe.dataset.loading = 'true';
                loadingSections.add(sectionId);

                const isActive = section.classList.contains('active');
                if (showLoader && isActive && loader) {
                    loader.style.display = 'flex';
                }

                iframe.style.display = isActive ? '' : 'none';

                iframe.onload = function () {
                    loadedSections.add(sectionId);
                    loadingSections.delete(sectionId);
                    if (section.classList.contains('active')) {
                        showIframe(section);
                    }
                };

                iframe.onerror = function () {
                    loadingSections.delete(sectionId);
                    if (loader && section.classList.contains('active')) {
                        loader.innerHTML = '<div style="color: #d32f2f; text-align: center;"><p>Gagal memuat halaman</p></div>';
                    }
                };

                iframe.src = src;
            }

            function prefetchIframeSection(sectionId) {
                loadIframeSection(sectionId, { showLoader: false });
            }

            function prefetchRemainingInIdle(skipSectionId) {
                const queue = IFRAME_SECTIONS.filter(function (id) {
                    return id !== skipSectionId && !isSectionLoaded(id);
                });

                let index = 0;

                function loadNext() {
                    if (index >= queue.length) return;
                    prefetchIframeSection(queue[index++]);
                    scheduleIdle(loadNext);
                }

                scheduleIdle(loadNext);
            }

            function scheduleIdle(callback) {
                if ('requestIdleCallback' in window) {
                    requestIdleCallback(callback, { timeout: 4000 });
                } else {
                    setTimeout(callback, 1200);
                }
            }

            function activateSection(sectionId, clickedBtn) {
                const targetContent = getSection(sectionId);
                if (!targetContent) return;

                document.querySelectorAll('.mall-action-btn').forEach(function (btn) {
                    btn.classList.remove('active');
                });
                document.querySelectorAll('.iframe-section').forEach(function (section) {
                    section.classList.remove('active');
                });

                if (clickedBtn) clickedBtn.classList.add('active');
                targetContent.classList.add('active');

                if (sectionId === 'comingSoon') {
                    return;
                }

                const loader = targetContent.querySelector('.iframe-loader');
                const iframe = targetContent.querySelector('iframe');

                if (isSectionLoaded(sectionId)) {
                    showIframe(targetContent);
                    return;
                }

                if (loadingSections.has(sectionId)) {
                    if (loader) loader.style.display = 'flex';
                    if (iframe) iframe.style.display = '';
                    return;
                }

                loadIframeSection(sectionId, { showLoader: true });
            }

            let searchScriptsPromise = null;

            function loadSearchScripts() {
                if (searchScriptsPromise) {
                    return searchScriptsPromise;
                }

                window.__mallSearchScriptsLoaded = true;

                function loadScript(src) {
                    return new Promise(function (resolve, reject) {
                        const script = document.createElement('script');
                        script.src = src;
                        script.onload = resolve;
                        script.onerror = reject;
                        document.body.appendChild(script);
                    });
                }

                searchScriptsPromise = loadScript('{{ asset('web-assets/search-modal-component.js') }}')
                    .then(function () {
                        return loadScript('{{ asset('web-assets/search.js') }}');
                    });

                return searchScriptsPromise;
            }

            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('navItemsContainer');
                const scrollLeftBtn = document.getElementById('scrollLeftBtn');
                const scrollRightBtn = document.getElementById('scrollRightBtn');
                const scrollAmount = 200;

                if (scrollLeftBtn && scrollRightBtn && container) {
                    scrollLeftBtn.addEventListener('click', function () {
                        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                    });

                    scrollRightBtn.addEventListener('click', function () {
                        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    });
                }

                const navButtons = document.querySelectorAll('#navItemsContainer .mall-action-btn[data-section]');

                navButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        activateSection(btn.getAttribute('data-section'), btn);
                    });

                    btn.addEventListener('mouseenter', function () {
                        const sectionId = btn.getAttribute('data-section');
                        if (!sectionId || sectionId === 'comingSoon') return;

                        clearTimeout(prefetchHoverTimer);
                        prefetchHoverTimer = setTimeout(function () {
                            prefetchIframeSection(sectionId);
                        }, 180);
                    });

                    btn.addEventListener('mouseleave', function () {
                        clearTimeout(prefetchHoverTimer);
                    });

                    btn.addEventListener('focus', function () {
                        const sectionId = btn.getAttribute('data-section');
                        if (sectionId && sectionId !== 'comingSoon') {
                            prefetchIframeSection(sectionId);
                        }
                    });
                });

                const searchBtn = document.getElementById('searchBtn');
                if (searchBtn) {
                    searchBtn.addEventListener('mouseenter', loadSearchScripts, { once: true });
                    searchBtn.addEventListener('focus', loadSearchScripts, { once: true });
                    searchBtn.addEventListener('click', function (e) {
                        if (window.__mallSearchReady) {
                            return;
                        }

                        e.preventDefault();
                        e.stopImmediatePropagation();

                        loadSearchScripts().then(function () {
                            window.__mallSearchReady = true;
                            searchBtn.click();
                        });
                    }, true);
                }

                loadIframeSection('profilDaerah', { showLoader: true });

                const profilSection = getSection('profilDaerah');
                if (profilSection) {
                    const profilIframe = profilSection.querySelector('iframe');
                    if (profilIframe) {
                        profilIframe.addEventListener('load', function () {
                            prefetchRemainingInIdle('profilDaerah');
                        }, { once: true });
                    } else {
                        prefetchRemainingInIdle('profilDaerah');
                    }
                }

                const urlParams = new URLSearchParams(window.location.search);
                const menuParam = urlParams.get('menu');
                if (menuParam) {
                    const menuMap = {
                        'profil': 'btnProfilDaerah',
                        'satudata': 'btnSatuData',
                        'pengumuman': 'btnPengumuman',
                        'jdih': 'btnJDIH',
                        'arsitekturSPBE': 'btnArsitekturSPBE',
                        'berita': 'btnBerita',
                        'proyek-strategis': 'btnProyekStrategisDaerah',
                        'transparansi-anggaran': 'btnTransparansiAnggaran',
                        'layanan-fase-kehidupan': 'btnLayananFaseKehidupan',
                        'informasi-adm': 'btnInformasiADM',
                        'informasi-publik': 'btnInformasiPublik'
                    };

                    const targetBtnId = menuMap[menuParam];
                    if (targetBtnId) {
                        const targetBtn = document.getElementById(targetBtnId);
                        if (targetBtn) {
                            targetBtn.click();
                            targetBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                        }
                    }
                }
            });
        })();
    </script>
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenuDropdown = document.getElementById('mobileMenuDropdown');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileMenuItems = document.querySelectorAll('.mobile-menu-item');
            const comingSoonTooltip = document.getElementById('comingSoonTooltip');
            const closeComingSoonTooltip = document.getElementById('closeComingSoonTooltip');

            const comingSoonItems = ['btnPengumuman', 'btnInformasiADM', 'btnInformasiPublik'];

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileMenuToggle.classList.toggle('active');
                    mobileMenuDropdown.classList.toggle('active');
                    mobileMenuOverlay.classList.toggle('active');
                });
            }

            mobileMenuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target');

                    if (comingSoonItems.includes(targetId)) {
                        comingSoonTooltip.classList.add('active');
                    } else {
                        const targetBtn = document.getElementById(targetId);
                        if (targetBtn) {
                            targetBtn.click();
                        }
                    }

                    if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
                    if (mobileMenuDropdown) mobileMenuDropdown.classList.remove('active');
                    if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('active');
                });
            });

            if (closeComingSoonTooltip) {
                closeComingSoonTooltip.addEventListener('click', function() {
                    comingSoonTooltip.classList.remove('active');
                });
            }

            if (comingSoonTooltip) {
                comingSoonTooltip.addEventListener('click', function(e) {
                    if (e.target === comingSoonTooltip) {
                        comingSoonTooltip.classList.remove('active');
                    }
                });
            }

            document.addEventListener('click', function(e) {
                if (comingSoonTooltip && comingSoonTooltip.classList.contains('active')) {
                    if (!e.target.closest('.coming-soon-tooltip')) {
                        comingSoonTooltip.classList.remove('active');
                    }
                }
            });

            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', function() {
                    if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
                    if (mobileMenuDropdown) mobileMenuDropdown.classList.remove('active');
                    mobileMenuOverlay.classList.remove('active');
                });
            }

            document.addEventListener('click', function(e) {
                if (mobileMenuToggle && mobileMenuDropdown && mobileMenuOverlay) {
                    if (!e.target.closest('.mall-hamburger-btn') &&
                        !e.target.closest('.mall-mobile-menu-dropdown')) {
                        mobileMenuToggle.classList.remove('active');
                        mobileMenuDropdown.classList.remove('active');
                        mobileMenuOverlay.classList.remove('active');
                    }
                }
            });
        });
    </script>
</body>

</html>