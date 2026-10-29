@push('styles')
        <style>
            /* Override base modal-content transform for ADM services */
            #admModal .modal-content.modal-adm-services {
                transform: scale(1) !important;
                background-image: none !important;
                overflow-y: auto;
                max-height: 90vh;
            }

            #admModal.show .modal-content.modal-adm-services {
                transform: scale(1) !important;
            }

            .adm-modal-header-enhanced {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                border-bottom: 2px solid #f0f0f0;
                background: #f9f9f9;
            }

            .adm-user-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .adm-user-info h4 {
                margin: 0;
                font-size: 16px;
                font-weight: 600;
                color: #333;
            }

            .adm-user-info .user-role {
                font-size: 12px;
                color: #666;
            }

            .service-btn[style*="display: none"] {
                display: none !important;
            }

            .adm-no-access-message {
                padding: 20px;
                text-align: center;
                color: #999;
                display: none;
            }

            .modal-body-adm.no-services-available .service-grid-adm {
                display: none !important;
            }

            .modal-body-adm.no-services-available .adm-no-access-message {
                display: block !important;
            }

            /* Ensure service grid is visible */
            #admModal .service-grid-adm {
                display: grid !important;
            }
        </style>
    @endpush

    <!-- ADM Modal Content (Inner Structure - Modal wrapper is in home.blade.php) -->
    <!-- This component is included inside the #admModal div in home.blade.php -->
    <div class="modal-content modal-adm-services">
        <div class="modal-header-adm" style="border-bottom: 2px solid #ddd;">
            <div class="header-title-section">
                <h2>LAYANAN ADMINISTRASI PEMERINTAH</h2>
                <div class="header-underline"></div>
            </div>
        </div>
        <div class="modal-body-adm" style="max-height: 70vh;">
            <div class="pub-user-info-section" style="background: var(--primary-red); padding: 20px 25px; color: white; margin-bottom: 5px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex: 1;">
                        <div style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 5px;">Masuk sebagai</div>
                        <div id="admUserName" style="font-size: 1.2rem; font-weight: 600; margin-bottom: 5px;">Pengguna</div>
                        <div id="admUserRole" style="font-size: 0.9rem; opacity: 0.9;">Jabatan: -</div>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button class="btn btn-sm btn-light" id="btnLogoutAdm" title="Keluar">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                        <button class="close-modal btn btn-sm btn-outline-light px-3">
                            <i class="bi bi-x"></i> <span class="text-light">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="adm-no-access-message">
                <p>Anda tidak memiliki akses ke layanan apapun sesuai dengan jabatan Anda.</p>
            </div>
            <div class="service-grid-adm">
                <!-- Card 1: Layanan Naskah Dinas & Kearsipan -->
                <div class="service-card-adm">
                    <div class="card-image-section">
                        <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                            alt="Layanan Naskah Dinas & Kearsipan" class="card-bg-image">
                        <div class="card-overlay"></div>
                        <h3 class="card-title">Layanan Naskah Dinas & Kearsipan</h3>
                    </div>
                    <div class="card-content-section">
                        <div class="service-btn-group">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://tndd.nunukankab.go.id/login/auth_sso') }}&name={{ urlencode('TATA NASKAH DINAS DIGITAL') }}"
                                class="service-btn adm-app-link" data-app-target="https://tndd.nunukankab.go.id/login/auth_sso" data-app-role="*" data-app-type="iframe"
                                title="TATA NASKAH DINAS DIGITAL">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/tndd.png') }}" alt="TNDD">
                                </div>
                                <span class="btn-text">TATA NASKAH DINAS DIGITAL</span>
                            </a>
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://srikandi.arsip.go.id/') }}&name={{ urlencode('SRIKANDI') }}"
                                class="service-btn adm-app-link" data-app-target="https://srikandi.arsip.go.id/" data-app-role="*" data-app-type="direct" title="SRIKANDI">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/srikandi.png') }}" alt="SRIKANDI">
                                </div>
                                <span class="btn-text">SRIKANDI</span>
                            </a>
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://sirapel.nunukankab.go.id/sso') }}&name={{ urlencode('SIRAPEL') }}"
                                class="service-btn adm-app-link" data-app-target="https://sirapel.nunukankab.go.id/sso" data-app-role="*" data-app-type="iframe" title="SIRAPEL">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/sirapel.png') }}" alt="SIRAPEL">
                                </div>
                                <span class="btn-text">SIRAPEL</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Layanan Manajemen Kepegawaian -->
                <div class="service-card-adm">
                    <div class="card-image-section">
                        <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                            alt="Layanan Manajemen Kepegawaian" class="card-bg-image">
                        <div class="card-overlay"></div>
                        <h3 class="card-title">Layanan Manajemen Kepegawaian</h3>
                    </div>
                    <div class="card-content-section">
                        <div class="service-btn-group">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://asndigital.bkn.go.id/') }}&name={{ urlencode('BKN') }}"
                                class="service-btn adm-app-link" data-app-target="https://asndigital.bkn.go.id/" data-app-role="*" data-app-type="direct" title="BKN">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/bkn.png') }}" alt="BKN">
                                </div>
                                <span class="btn-text">BKN</span>
                            </a>
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://eanjab.nunukankab.go.id/sso.php') }}&name={{ urlencode('ANJAB') }}"
                                class="service-btn adm-app-link" data-app-target="https://eanjab.nunukankab.go.id/sso.php" data-app-role="*" data-app-type="iframe" title="ANJAB">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/eanjab.png') }}" alt="ANJAB">
                                </div>
                                <span class="btn-text">EANJAB</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Layanan Manajemen Perencanaan & Anggaran -->
                <div class="service-card-adm">
                    <div class="card-image-section">
                        <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                            alt="Layanan Manajemen Perencanaan & Anggaran" class="card-bg-image">
                        <div class="card-overlay"></div>
                        <h3 class="card-title">Layanan Manajemen Perencanaan & Anggaran</h3>
                    </div>
                    <div class="card-content-section">
                        <div class="service-btn-group">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://sipecel.nunukankab.go.id/login/auth_sso') }}&name={{ urlencode('SIPECEL') }}"
                                class="service-btn adm-app-link" data-app-target="https://sipecel.nunukankab.go.id/login/auth_sso" data-app-role="*" data-app-type="iframe" title="SIPECEL">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/sipecel.png') }}" alt="SIPECEL">
                                </div>
                                <span class="btn-text">SIPECEL</span>
                            </a>
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://sipd.kemendagri.go.id/') }}&name={{ urlencode('SIPD') }}"
                                class="service-btn adm-app-link" data-app-target="https://sipd.kemendagri.go.id/" data-app-role="*" data-app-type="direct" title="SIPD">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/sipd.png') }}" alt="SIPD">
                                </div>
                                <span class="btn-text">SIPD</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Layanan Manajemen Keuangan -->
                <div class="service-card-adm">
                    <div class="card-image-section">
                        <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                            alt="Layanan Manajemen Keuangan" class="card-bg-image">
                        <div class="card-overlay"></div>
                        <h3 class="card-title">Layanan Manajemen Keuangan</h3>
                    </div>
                    <div class="card-content-section">
                        <div class="service-btn-group">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://nunukankab.fmis.id/2023/') }}&name={{ urlencode('FMIS') }}"
                                class="service-btn adm-app-link" data-app-target="https://nunukankab.fmis.id/2023/" data-app-role="*" data-app-type="iframe" title="FMIS">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/fmis.png') }}" alt="FMIS">
                                </div>
                                <span class="btn-text">FMIS</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Layanan Manajemen Kinerja -->
                <div class="service-card-adm">
                    <div class="card-image-section">
                        <img src="{{ asset('web-assets/assets/img/public-service-card-header.png') }}"
                            alt="Layanan Manajemen Kinerja" class="card-bg-image">
                        <div class="card-overlay"></div>
                        <h3 class="card-title">Layanan Manajemen Kinerja</h3>
                    </div>
                    <div class="card-content-section">
                        <div class="service-btn-group">
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://ekinerja.nunukankab.go.id/presence/sso.php') }}&name={{ urlencode('E-PRESENCE') }}"
                                class="service-btn adm-app-link" data-app-target="https://ekinerja.nunukankab.go.id/presence/sso.php" data-app-role="*" data-app-type="epresence"
                                title="E-PRESENCE">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/epresence.png') }}" alt="E-PRESENCE">
                                </div>
                                <span class="btn-text">E-PRESENCE</span>
                            </a>
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://ekinerja.nunukankab.go.id/login/sso.php') }}&name={{ urlencode('SIMANJA') }}"
                                class="service-btn adm-app-link" data-app-target="https://ekinerja.nunukankab.go.id/login/sso.php" data-app-role="*" data-app-type="iframe" title="SIMANJA">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/simanja.png') }}" alt="SIMANJA">
                                </div>
                                <span class="btn-text">SIMANJA</span>
                            </a>
                            <a href="{{ route('web.adm-services') }}?url={{ urlencode('https://sepakat.nunukankab.go.id/auth/sso') }}&name={{ urlencode('SEPAKAT') }}"
                                class="service-btn adm-app-link" data-app-target="https://sepakat.nunukankab.go.id/auth/sso" data-app-role="*" data-app-type="iframe" title="SEPAKAT">
                                <div class="btn-icon">
                                    <img src="{{ asset('web-assets/assets/img/sepakat.png') }}" alt="SEPAKAT">
                                </div>
                                <span class="btn-text">SEPAKAT</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize ADM Modal with user info
                initializeAdmModal();
            });

            function initializeAdmModal() {
                // Get SSO data from session (populated by Blade in home.blade.php)
                const ssoDataElement = document.getElementById('admSsoData');
                if (!ssoDataElement) {
                    console.error('❌ ERROR: SSO data script tag (#admSsoData) not found in page');
                    return;
                }

                try {
                    const ssoData = JSON.parse(ssoDataElement.textContent);
                    const accessToken = ssoData.access_token;
                    const jabatan = ssoData.jabatan || '';
                    const name = ssoData.name || jabatan.split(' ')[0] || 'Pengguna';

                    console.log('✓ SSO Data found and parsed');
                    console.log('  - Name:', name);
                    console.log('  - Jabatan:', jabatan);
                    console.log('  - Access Token:', accessToken.substring(0, 20) + '...');

                    // Store in localStorage for easy access
                    localStorage.setItem('admAccessToken', accessToken);
                    localStorage.setItem('admJabatan', jabatan);
                    localStorage.setItem('admName', name);
                    console.log('✓ Data stored in localStorage');

                    // Set user display name
                    setupAdmUserDisplay();
                    console.log('✓ User display name updated');

                    // Apply role filtering immediately
                    applyAdmRoleFiltering();
                    console.log('✓ Role filtering applied');

                    // Setup app link handlers
                    setupAdmAppLinkHandlers(accessToken);
                    console.log('✓ App link handlers setup');

                    console.log('✅ ADM Modal fully initialized!');
                } catch (error) {
                    console.error('❌ ERROR in initializeAdmModal:', error);
                }
            }

            function setupAdmUserDisplay() {
                const name = localStorage.getItem('admName') || localStorage.getItem('admJabatan') || 'Pengguna';
                const jabatan = localStorage.getItem('admJabatan') || '';
                document.getElementById('admUserName').textContent = name;
                document.getElementById('admUserRole').textContent = 'Jabatan: ' + jabatan;
            }

            function applyAdmRoleFiltering() {
                const jabatanString = (localStorage.getItem('admJabatan') || '').toLowerCase().trim();
                const appLinks = document.querySelectorAll('.adm-app-link');
                let visibleCount = 0;

                console.log('🔍 Starting role filtering with jabatan:', jabatanString);
                console.log('📊 Total app links found:', appLinks.length);

                appLinks.forEach((link, index) => {
                    const requiredRole = link.getAttribute('data-app-role') || '*';
                    const appName = link.getAttribute('title') || 'Unknown';

                    if (requiredRole === '*') {
                        link.style.display = '';
                        visibleCount++;
                        console.log(`  ✓ [${index}] ${appName}: Role="*" → VISIBLE`);
                    } else {
                        const roles = requiredRole.split(';').map(r => r.trim().toLowerCase());
                        let hasRole = false;

                        for (let role of roles) {
                            if (jabatanString.includes(role)) {
                                hasRole = true;
                                break;
                            }
                        }

                        if (hasRole) {
                            link.style.display = '';
                            visibleCount++;
                            console.log(`  ✓ [${index}] ${appName}: Matched roles → VISIBLE`);
                        } else {
                            link.style.display = 'none';
                            console.log(`  ✗ [${index}] ${appName}: No matching roles → HIDDEN`);
                        }
                    }
                });

                // Show/hide no access message & grid
                const modalBody = document.querySelector('.modal-body-adm');
                const serviceGrid = document.querySelector('.service-grid-adm');
                const noAccessMsg = document.querySelector('.adm-no-access-message');

                if (visibleCount === 0) {
                    console.warn('❌ No accessible services found for this role!');
                    if (modalBody) modalBody.classList.add('no-services-available');
                    if (serviceGrid) serviceGrid.style.display = 'none';
                    if (noAccessMsg) noAccessMsg.style.display = 'block';
                } else {
                    console.log(`✅ Showing ${visibleCount} visible services`);
                    if (modalBody) modalBody.classList.remove('no-services-available');
                    if (serviceGrid) serviceGrid.style.display = '';
                    if (noAccessMsg) noAccessMsg.style.display = 'none';
                }

                console.log(`✓ ADM Services Filtering Complete: ${visibleCount}/${appLinks.length} visible`);
            }

            function setupAdmAppLinkHandlers(accessToken) {
                const appLinks = document.querySelectorAll('.adm-app-link');

                appLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        const appType = this.getAttribute('data-app-type');
                        const appTarget = this.getAttribute('data-app-target');
                        const appName = this.getAttribute('title') || 'Service';
                        const href = this.getAttribute('href');

                        console.log(`🔗 Service clicked: ${appName} (Type: ${appType})`);
                        console.log(`  - Target: ${appTarget}`);

                        if (appType === 'direct') {
                            // Direct link - open in new tab without token
                            e.preventDefault();
                            console.log(`🌐 Opening DIRECT in new tab: ${appTarget}`);
                            window.open(appTarget, '_blank');
                        } 
                        else if (appType === 'epresence') {
                            // E-Presence - open in new tab with access token
                            e.preventDefault();
                            let openUrl = appTarget.includes('?')
                                ? appTarget + '&access_token=' + accessToken
                                : appTarget + '?access_token=' + accessToken;
                            console.log(`🌐 Opening EPRESENCE in new tab with token: ${openUrl}`);
                            window.open(openUrl, '_blank');
                        }
                        else if (appType === 'iframe') {
                            // Iframe - navigate to administration service page using SSO endpoint from data-app-target
                            e.preventDefault();
                            const encodedUrl = encodeURIComponent(appTarget);
                            const encodedName = encodeURIComponent(appName);
                            const servicePageUrl = '{{ route("web.adm-services") }}?url=' + encodedUrl + '&name=' + encodedName;
                            console.log(`📄 Navigating to iframe service page: ${servicePageUrl}`);
                            window.location.href = servicePageUrl;
                        }
                    });
                });
            }
        </script>
    @endpush