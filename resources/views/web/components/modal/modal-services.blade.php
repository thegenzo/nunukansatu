@push('styles')
    <style>
        /* Modal Overlay Base Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1050;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.show {
            display: flex !important;
        }

        /* Override modal-content transform for services modal */
        #servicesModal .modal-content.modal-services {
            transform: scale(1) !important;
            background-image: none !important;
            overflow-y: auto;
            max-height: 90vh;
            width: 90%;
            max-width: 700px;
        }

        #servicesModal.show .modal-content.modal-services {
            transform: scale(1) !important;
        }

        .services-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid #f0f0f0;
            background: #f9f9f9;
        }

        .services-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
                padding: 15px;
            }
        }

        .service-category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .service-category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            border-color: #D32F2F;
        }

        .service-category-header {
            background: linear-gradient(135deg, #D32F2F 0%, #B71C1C 100%);
            color: white;
            padding: 20px;
            text-align: center;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .service-category-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
        }

        .service-category-header i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .service-category-body {
            padding: 20px;
        }

        .service-category-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            line-height: 1.5;
        }

        .service-category-button {
            width: 100%;
            background-color: #D32F2F;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .service-category-button:hover {
            background-color: #B71C1C;
            transform: scale(1.02);
        }

        .service-category-button i {
            font-size: 16px;
        }

        .services-modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #f0f0f0;
            text-align: right;
        }

        .services-modal-footer .close-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .services-modal-footer .close-btn:hover {
            background-color: #5a6268;
        }
    </style>
@endpush

<!-- Services Modal -->
<div id="servicesModal" class="modal-overlay" aria-hidden="true">
    <div class="modal-content modal-services">
        <!-- Header -->
        <div class="services-modal-header">
            <h2 class="services-title">Kategori Layanan</h2>
            <button class="close-modal btn btn-sm btn-danger" title="Tutup">
                <i class="bi bi-x"></i>
                <span>Tutup</span>
            </button>
        </div>

        <!-- Services Grid -->
        <div class="services-grid">
            <!-- Card 1: Layanan Administrasi Pemerintah -->
            <div class="service-category-card" id="cardLayananAdm">
                <div class="service-category-header">
                    <i class="bi bi-building"></i>
                    <h3>Layanan Administrasi<br>Pemerintah</h3>
                </div>
                <div class="service-category-body">
                    <p class="service-category-description">
                        Akses layanan administrasi pemerintah seperti TNDD, BKN, FMIS, dan layanan manajemen lainnya.
                    </p>
                    <button class="service-category-button" id="btnLayananAdmin">
                        <i class="bi bi-arrow-right"></i>
                        <span>Masuk ke Layanan</span>
                    </button>
                </div>
            </div>

            <!-- Card 2: Layanan Publik -->
            <div class="service-category-card" id="cardLayananPublik">
                <div class="service-category-header">
                    <i class="bi bi-info-circle"></i>
                    <h3>Layanan Publik</h3>
                </div>
                <div class="service-category-body">
                    <p class="service-category-description">
                        Akses layanan publik seperti LAPOR, JDIH, GIS, PPID, dan layanan informasi lainnya.
                    </p>
                    <button class="service-category-button" id="btnLayananPublik">
                        <i class="bi bi-arrow-right"></i>
                        <span>Masuk ke Layanan</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="services-modal-footer">
            <button class="close-btn close-modal">
                <i class="bi bi-x-circle"></i> Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        // Services Modal Handler
        // This will be setup after DOMContentLoaded is called by the main home page
        
        function setupServicesModal() {
            // Get button elements
            const btnLayananAdmin = document.getElementById('btnLayananAdmin');
            const btnLayananPublik = document.getElementById('btnLayananPublik');
            const servicesModal = document.getElementById('servicesModal');
            const closeModalBtns = servicesModal ? servicesModal.querySelectorAll('.close-modal, .close-btn') : [];

            if (!servicesModal) {
                console.warn('⚠ Services modal (#servicesModal) not found');
                return;
            }

            // Setup Layanan Administrasi Pemerintah button
            if (btnLayananAdmin) {
                btnLayananAdmin.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    console.log('🔗 Layanan Administrasi Pemerintah clicked');

                    // Check if user is authenticated via SSO
                    const admAccessToken = localStorage.getItem('admAccessToken');
                    const admJabatan = localStorage.getItem('admJabatan');

                    if (admAccessToken && admJabatan) {
                        // User is already logged in, show ADM services modal
                        console.log('✓ User already authenticated, showing ADM services');
                        closeServicesModal();
                        showAdmModal();
                    } else {
                        // User not logged in, show SSO login modal or admin login
                        console.log('⚠ User not authenticated, redirecting to SSO login');
                        localStorage.setItem('intended_service', 'admin');
                        window.location.href = '{{ route("web.sso-login") }}';
                    }
                });
            }

            // Setup Layanan Publik button
            if (btnLayananPublik) {
                btnLayananPublik.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    console.log('🔗 Layanan Publik clicked');

                    // Layanan Publik doesn't require authentication
                    closeServicesModal();
                    showPublicModal();
                });
            }

            // Setup close modal buttons
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    closeServicesModal();
                });
            });

            // Close modal when clicking outside
            if (servicesModal) {
                servicesModal.addEventListener('click', function (e) {
                    if (e.target === servicesModal) {
                        closeServicesModal();
                    }
                });
            }

            console.log('✓ Services Modal setup complete');
        }

        // Call setup when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', setupServicesModal);
        } else {
            setupServicesModal();
        }

        // Utility functions
        function closeServicesModal() {
            const servicesModal = document.getElementById('servicesModal');
            if (servicesModal) {
                servicesModal.classList.remove('show');
                setTimeout(() => {
                    servicesModal.style.display = 'none';
                }, 300);
            }
        }

        function showAdmModal() {
            const admModal = document.getElementById('admModal');
            if (admModal) {
                admModal.style.display = 'flex';
                setTimeout(() => {
                    admModal.classList.add('show');
                }, 10);
            } else {
                console.error('❌ ADM Modal (#admModal) not found');
            }
        }

        function showPublicModal() {
            const publicModal = document.getElementById('publicModal');
            if (publicModal) {
                publicModal.style.display = 'flex';
                setTimeout(() => {
                    publicModal.classList.add('show');
                }, 10);
            } else {
                console.error('❌ Public Modal (#publicModal) not found');
            }
        }
    </script>
@endpush
