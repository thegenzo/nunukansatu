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
                <div id="userInfoSection" style="margin-right: 20px; display: none;">
                    <small style="color: #666; font-size: 12px;">
                        User: <strong id="userNameDisplay">-</strong>
                    </small>
                </div>
                <button id="searchBtn" class="btn btn-primary-red rounded-3 px-4 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </button>
                <button id="btnLogoutAdm" class="btn btn-danger rounded-3 px-4 py-2 d-flex align-items-center gap-2" 
                    style="margin-left: 10px; display: none;" title="Keluar dari layanan">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
                <a href="{{ route('web.home') }}" class="btn-navbar-news">
                    <i class="bi bi-arrow-return-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </header>

    <!-- SSO Data for JavaScript -->
    @if (session('sso_data'))
    <script type="application/json" id="admServiceSsoData">{!! session('sso_data') !!}</script>
    @endif



    <!-- Biarkan src kosong, akan diisi oleh JavaScript -->
    <iframe id="layanan-iframe" style="width: 100%; height: calc(100vh - 100px)" src="" frameborder="0"></iframe>

    <script src="../search-modal-component.js"></script>
    <script src="../search.js"></script>

    <!-- Full Page Modal for Iframe Apps -->
    <div id="fullPageAdmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullPageAdmModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullPageAdmModalLabel">Loading...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe id="fullPageAdmIframe" style="width: 100%; height: calc(100vh - 150px); border: none;" src="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian JavaScript untuk mengambil parameter URL -->
    <script>
        // Global variables for SSO
        let accessToken = null;
        let isSsoAuthenticated = false;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function () {
            initializeUserInfo();

            // 1. Ambil Query Parameters dari URL (misal: ?name=TNDD&url=...)
            const urlParams = new URLSearchParams(window.location.search);

            // 2. Ekstrak nilai dari 'name' dan 'url'
            const serviceName = urlParams.get('name');
            const serviceUrl = urlParams.get('url');

            // 3. Pastikan parameter ada sebelum memanipulasi DOM
            if (serviceName && serviceUrl && serviceUrl !== '#') {
                // Ubah Title Halaman
                document.title = `${serviceName} - Nunukan Satu`;

                // Ubah Judul Layanan di Header (Navbar)
                document.getElementById('layanan-title').textContent = serviceName;

                // Append access token if authenticated
                let finalServiceUrl = serviceUrl;
                if (isSsoAuthenticated && accessToken) {
                    const separator = serviceUrl.includes('?') ? '&' : '?';
                    finalServiceUrl = serviceUrl + separator + 'access_token=' + accessToken;
                }

                // Ubah dan Muat URL ke dalam Iframe
                document.getElementById('layanan-iframe').src = finalServiceUrl;
            } else {
                // Tampilkan pesan error jika URL diakses secara langsung tanpa parameter atau url kosong
                document.getElementById('layanan-title').textContent = serviceName || "Layanan Tidak Ditemukan";
                document.getElementById('layanan-iframe').outerHTML = `
                    <div class="container mt-5 text-center">
                        <h2 style="color: white">Maaf, URL layanan belum tersedia atau tidak valid.</h2>
                        <a href="{{ route('web.home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                    </div>
                `;
            }

            setupLogoutButton();
            setupBurgerMenu();
        });

        function initializeUserInfo() {
            const ssoDataElement = document.getElementById('admServiceSsoData');
            if (ssoDataElement) {
                const ssoData = JSON.parse(ssoDataElement.textContent);
                accessToken = ssoData.access_token;
                isSsoAuthenticated = true;
                localStorage.setItem('admServiceAccessToken', accessToken);
                localStorage.setItem('admServiceJabatan', ssoData.jabatan || '');
                localStorage.setItem('admServiceName', ssoData.name || ssoData.jabatan || '');
                
                // Display user info in navbar
                const userNameDisplay = document.getElementById('userNameDisplay');
                const userInfoSection = document.getElementById('userInfoSection');
                const btnLogoutAdm = document.getElementById('btnLogoutAdm');
                
                if (userNameDisplay) {
                    userNameDisplay.textContent = ssoData.name || (ssoData.jabatan ? ssoData.jabatan.split(' ')[0] : '-');
                }
                if (userInfoSection) userInfoSection.style.display = 'flex';
                if (btnLogoutAdm) btnLogoutAdm.style.display = 'flex';
            } else {
                // Fallback to localStorage if session not fresh
                const storedToken = localStorage.getItem('admServiceAccessToken') || localStorage.getItem('admAccessToken');
                if (storedToken) {
                    accessToken = storedToken;
                    isSsoAuthenticated = true;
                    const storedName = localStorage.getItem('admServiceName') || localStorage.getItem('admName') || localStorage.getItem('admServiceJabatan') || localStorage.getItem('admJabatan');
                    
                    const userNameDisplay = document.getElementById('userNameDisplay');
                    const userInfoSection = document.getElementById('userInfoSection');
                    const btnLogoutAdm = document.getElementById('btnLogoutAdm');
                    
                    if (userNameDisplay && storedName) {
                        userNameDisplay.textContent = storedName;
                    }
                    if (userInfoSection) userInfoSection.style.display = 'flex';
                    if (btnLogoutAdm) btnLogoutAdm.style.display = 'flex';
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

            document.addEventListener('click', function (e) {
                if (!burgerBtn.contains(e.target) && !navActions.contains(e.target)) {
                    navActions.classList.remove('burger-open');
                    burgerBtn.setAttribute('aria-expanded', 'false');
                    burgerBtn.querySelector('i').className = 'bi bi-list';
                }
            });
        }

        function setupLogoutButton() {
            const logoutBtn = document.getElementById('btnLogoutAdm');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', () => {
                    // Clear all SSO-related localStorage
                    localStorage.removeItem('admServiceAccessToken');
                    localStorage.removeItem('admServiceJabatan');
                    localStorage.removeItem('admServiceName');
                    localStorage.removeItem('admAccessToken');
                    localStorage.removeItem('admJabatan');
                    localStorage.removeItem('admName');
                    localStorage.removeItem('pubAccessToken');
                    localStorage.removeItem('pubJabatan');
                    localStorage.removeItem('pubUserName');
                    localStorage.removeItem('sso_session');
                    
                    console.log('✓ Logout: Clearing SSO session and redirecting...');
                    window.location.href = '{{ route("web.sso-logout") }}';
                });
            }
        }
    </script>
</body>

</html>