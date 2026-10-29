<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat Layanan... - Nunukan Satu</title>
    <link rel="icon" href="{{ asset('assets/favnunukan.png') }}" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('web-assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web-assets/public-services.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <header class="navbar-header">
        <div class="navbar-decor-left"></div>
        <div class="navbar-decor-right"></div>
        <div class="navbar-content container-fluid d-flex justify-content-between align-items-center flex-wrap">
            <div class="navbar-logo-section">
                <img src="{{ asset('web-assets/assets/img/nunukan-icon.png') }}" alt="Nunukan Satu Logo" class="navbar-logo">
                <div>
                    <h1 class="navbar-title" id="layanan-title">Memuat...</h1>
                    <div class="navbar-bar"></div>
                </div>
            </div>
            <button id="burgerBtn" class="burger-menu-btn" aria-label="Toggle menu" aria-expanded="false">
                <i class="bi bi-list"></i>
            </button>
            <div class="navbar-actions" id="navbarActions">
                @if (session('sso_data'))
                <div id="userInfoSection" style="margin-right: 20px; display: none;">
                    <small style="color: #666; font-size: 12px;">
                        User: <strong id="userNameDisplay">-</strong>
                    </small>
                </div>
                @endif
                <button id="searchBtn" class="btn btn-primary-red rounded-3 px-4 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </button>

                @if (session('sso_data'))
                <button id="btnLogoutService" class="btn btn-danger rounded-3 px-4 py-2 d-flex align-items-center gap-2" 
                    style="margin-left: 10px; display: none;" title="Keluar dari layanan">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
                @endif

                <a href="{{ route('web.home') }}" class="btn-navbar-news">
                    <i class="bi bi-arrow-return-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </header>

    <!-- SSO Data for JavaScript -->
    @if (session('sso_data'))
    <script type="application/json" id="publicServiceSsoData">{!! session('sso_data') !!}</script>
    @endif



    <!-- Biarkan src kosong, akan diisi oleh JavaScript -->
    <iframe id="layanan-iframe" style="width: 100%; height: calc(100vh - 100px)" src="" frameborder="0"></iframe>
    
    <!-- Full Page Modal for Iframe Apps -->
    <div id="fullPageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullPageModalLabel">Loading...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe id="appIframe" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('web-assets/search-modal-component.js') }}"></script>
    <script src="{{ asset('web-assets/search.js') }}"></script>

    <!-- Bagian JavaScript untuk mengambil parameter URL dan handling SSO -->
    <script>
        // Global variables
        let accessToken = null;
        let isSsoAuthenticated = false;

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize user info and SSO
            initializeUserInfo();
            
            // Ambil parameter dari query string
            const urlParams = new URLSearchParams(window.location.search);
            const serviceName = urlParams.get('name');
            const serviceUrl = urlParams.get('url');

            // Pastikan parameter ada sebelum memanipulasi DOM
            if (serviceName && serviceUrl) {
                // Ubah Title Halaman
                document.title = `${serviceName} - Nunukan Satu`;

                // Ubah Judul Layanan di Header (Navbar)
                document.getElementById('layanan-title').textContent = serviceName;

                // Ubah dan Muat URL ke dalam Iframe (dengan access token jika ada)
                let finalServiceUrl = serviceUrl;
                
                // Add access token to URL if user is SSO authenticated
                if (isSsoAuthenticated && accessToken) {
                    const separator = serviceUrl.includes('?') ? '&' : '?';
                    finalServiceUrl = serviceUrl + separator + 'access_token=' + accessToken;
                }
                
                document.getElementById('layanan-iframe').src = finalServiceUrl;
            } else {
                // Tampilkan pesan error jika URL diakses secara langsung tanpa parameter
                document.getElementById('layanan-title').textContent = "Layanan Tidak Ditemukan";
                document.getElementById('layanan-iframe').outerHTML = `
                    <div class="container mt-5 text-center">
                        <h2 style="color: white">Maaf, terjadi kesalahan. Parameter url atau name tidak valid.</h2>
                        <a href="{{ route('web.home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                    </div>
                `;
            }

            // Setup logout button
            setupLogoutButton();

            // Setup burger menu
            setupBurgerMenu();
        });

        function initializeUserInfo() {
            // Try to get SSO data from page script
            const ssoDataElement = document.getElementById('publicServiceSsoData');
            
            if (ssoDataElement) {
                try {
                    const ssoData = JSON.parse(ssoDataElement.textContent);
                    accessToken = ssoData.access_token;
                    isSsoAuthenticated = true;
                    
                    // Store in localStorage for persistence
                    localStorage.setItem('pubAccessToken', accessToken);
                    localStorage.setItem('pubJabatan', ssoData.jabatan || '');
                    localStorage.setItem('pubUserName', ssoData.name || ssoData.jabatan || '');
                    
                    // Display user info
                    const userName = ssoData.name || (ssoData.jabatan ? ssoData.jabatan.split(' ')[0] : 'User');
                    document.getElementById('userNameDisplay').textContent = userName;
                    document.getElementById('userInfoSection').style.display = 'block';
                    document.getElementById('btnLogoutService').style.display = 'flex';
                    
                    console.log('✅ SSO User authenticated:', ssoData.name || ssoData.jabatan);
                } catch (e) {
                    console.warn('⚠️ Failed to parse SSO data:', e);
                }
            } else {
                // Try to get from localStorage as fallback
                const storedToken = localStorage.getItem('pubAccessToken') || localStorage.getItem('admAccessToken');
                const storedName = localStorage.getItem('pubUserName') || localStorage.getItem('admName') || localStorage.getItem('pubJabatan') || localStorage.getItem('admJabatan');
                
                if (storedToken) {
                    accessToken = storedToken;
                    isSsoAuthenticated = true;
                    
                    const userName = storedName || 'User';
                    document.getElementById('userNameDisplay').textContent = userName;
                    document.getElementById('userInfoSection').style.display = 'block';
                    document.getElementById('btnLogoutService').style.display = 'flex';
                    
                    console.log('✅ SSO User restored from localStorage:', storedJabatan);
                }
            }
        }

        function setupBurgerMenu() {
            const burgerBtn = document.getElementById('burgerBtn');
            const navActions = document.getElementById('navbarActions');
            if (!burgerBtn || !navActions) return;

            burgerBtn.addEventListener('click', function () {
                const isOpen = navActions.classList.toggle('burger-open');
                burgerBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                burgerBtn.querySelector('i').className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
            });

            // Close menu when clicking outside
            document.addEventListener('click', function (e) {
                if (!burgerBtn.contains(e.target) && !navActions.contains(e.target)) {
                    navActions.classList.remove('burger-open');
                    burgerBtn.setAttribute('aria-expanded', 'false');
                    burgerBtn.querySelector('i').className = 'bi bi-list';
                }
            });
        }

        function setupLogoutButton() {
            const logoutBtn = document.getElementById('btnLogoutService');
            if (!logoutBtn) return;

            logoutBtn.addEventListener('click', function() {
                // Clear all SSO-related localStorage
                localStorage.removeItem('pubAccessToken');
                localStorage.removeItem('pubJabatan');
                localStorage.removeItem('admAccessToken');
                localStorage.removeItem('admJabatan');
                localStorage.removeItem('admServiceAccessToken');
                localStorage.removeItem('admServiceJabatan');
                localStorage.removeItem('sso_session');
                
                console.log('✓ Logout: Clearing SSO session and redirecting...');
                // Redirect to SSO logout to clear server session
                window.location.href = '{{ route("web.sso-logout") }}';
            });
        }
    </script>

</body>

</html>