// ============================================
// MODAL SETUP - Public & ADM Services
// ============================================
document.addEventListener('DOMContentLoaded', function () {
    // Helper function to setup modal interactions
    function setupModal(modalId, buttonSelector) {
        const modal = document.getElementById(modalId);
        const btn = document.querySelector(buttonSelector);
        const closeBtn = modal ? modal.querySelector('.close-modal') : null;

        if (!modal || !btn || !closeBtn) {
            console.error(`Modal ${modalId} elements not found`);
            return;
        }

        // Open modal
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        });

        // Close modal when clicking X
        closeBtn.addEventListener('click', function () {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        });

        // Close modal when clicking outside modal-content
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }
        });
    }

    // Setup modals for Public & ADM Services
    setupModal('publicModal', 'a[href="#"].menu-btn.btn-left');
    setupModal('admModal', 'a.menu-btn.btn-top');

    // ============================================
    // PENGADUAN MODAL & POPUP
    // ============================================
    const pengaduanModal = document.getElementById('pengaduanModal');
    const pengaduanBtn = document.querySelector('footer button.btn-outline-danger');
    const pengaduanCloseBtn = pengaduanModal ? pengaduanModal.querySelector('.close-modal') : null;

    if (pengaduanModal && pengaduanBtn && pengaduanCloseBtn) {
        // Open pengaduan modal
        pengaduanBtn.addEventListener('click', function (e) {
            e.preventDefault();
            pengaduanModal.style.display = 'flex';
            setTimeout(() => {
                pengaduanModal.classList.add('show');
            }, 10);
        });

        // Close pengaduan modal when clicking X
        pengaduanCloseBtn.addEventListener('click', function () {
            pengaduanModal.classList.remove('show');
            setTimeout(() => {
                pengaduanModal.style.display = 'none';
            }, 300);
        });

        // Close pengaduan modal when clicking outside
        window.addEventListener('click', function (e) {
            if (e.target === pengaduanModal) {
                pengaduanModal.classList.remove('show');
                setTimeout(() => {
                    pengaduanModal.style.display = 'none';
                }, 300);
            }
        });
    } else {
        console.error('Pengaduan modal elements not found');
    }

    // Pengaduan Popup
    const pengaduanPopup = document.getElementById('pengaduanPopup');
    const pengaduanPopupBtn = document.querySelector('footer button.btn-outline-danger');

    if (pengaduanPopup && pengaduanPopupBtn) {
        // Toggle pengaduan popup
        pengaduanPopupBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (pengaduanPopup.classList.contains('show')) {
                pengaduanPopup.classList.remove('show');
                pengaduanPopupBtn.classList.remove('btn-pengaduan-active');
            } else {
                pengaduanPopup.classList.add('show');
                pengaduanPopupBtn.classList.add('btn-pengaduan-active');
            }
        });

        // Close popup when clicking outside
        document.addEventListener('click', function (e) {
            if (!pengaduanPopup.contains(e.target) && !pengaduanPopupBtn.contains(e.target)) {
                pengaduanPopup.classList.remove('show');
                pengaduanPopupBtn.classList.remove('btn-pengaduan-active');
            }
        });
    } else {
        console.error('Pengaduan popup elements not found');
    }

    // ============================================
    // LIVE CHAT MODAL
    // ============================================
    const liveChatModal = document.getElementById('liveChatModal');
    const liveChatBtn = document.getElementById('liveChatBtn');
    const liveChatForm = document.getElementById('liveChatForm');
    const liveChatCloseBtn = liveChatModal ? liveChatModal.querySelector('.live-chat-close') : null;

    if (liveChatModal && liveChatBtn && liveChatCloseBtn) {
        // Open live chat modal
        liveChatBtn.addEventListener('click', function (e) {
            e.preventDefault();
            liveChatModal.style.display = 'flex';
            setTimeout(() => {
                liveChatModal.classList.add('show');
            }, 10);
        });

        // Close live chat modal when clicking X
        liveChatCloseBtn.addEventListener('click', function () {
            liveChatModal.classList.remove('show');
            setTimeout(() => {
                liveChatModal.style.display = 'none';
            }, 300);
        });

        // Close live chat modal when clicking outside modal-content
        liveChatModal.addEventListener('click', function (e) {
            if (e.target === liveChatModal) {
                liveChatModal.classList.remove('show');
                setTimeout(() => {
                    liveChatModal.style.display = 'none';
                }, 300);
            }
        });

        // Handle form submission
        if (liveChatForm) {
            liveChatForm.addEventListener('submit', function (e) {
                e.preventDefault();
                
                // Get form values
                const email = document.getElementById('chatEmail').value;
                const name = document.getElementById('chatName').value;
                const message = document.getElementById('chatMessage').value;

                // Log the form data (In real scenario, this would be sent to a server)
                console.log('Live Chat Form Submitted:', {
                    email: email,
                    name: name,
                    message: message
                });

                // Show success message (optional)
                alert(`Terima kasih ${name}! Pesan Anda telah dikirim. Kami akan menghubungi Anda segera di ${email}`);

                // Reset form
                liveChatForm.reset();

                // Close modal
                liveChatModal.classList.remove('show');
                setTimeout(() => {
                    liveChatModal.style.display = 'none';
                }, 300);
            });
        }
    } else {
        console.error('Live Chat modal elements not found');
    }

    // ============================================
    // ADM MODAL LOGOUT HANDLER
    // ============================================
    // Use event delegation to handle logout button clicks
    // Works whether button exists at DOMContentLoaded or is added later
    const admModal = document.getElementById('admModal');
    
    if (admModal) {
        admModal.addEventListener('click', function (e) {
            // Check if clicked element is or contains btnLogoutAdm
            const logoutBtn = e.target.closest('#btnLogoutAdm');
            
            if (logoutBtn) {
                e.preventDefault();
                
                // Clear all SSO-related localStorage
                localStorage.removeItem('admAccessToken');
                localStorage.removeItem('admJabatan');
                localStorage.removeItem('admName');
                localStorage.removeItem('admServiceAccessToken');
                localStorage.removeItem('admServiceJabatan');
                localStorage.removeItem('admServiceName');
                localStorage.removeItem('pubAccessToken');
                localStorage.removeItem('pubJabatan');
                localStorage.removeItem('pubUserName');
                localStorage.removeItem('sso_session');
                
                console.log('✓ ADM Logout: SSO session cleared, redirecting to logout...');
                
                // Redirect to SSO logout to clear server session
                window.location.href = '/sso/logout';
            }
        });
    }

    // ============================================
    // PUBLIC MODAL LOGOUT HANDLER
    // ============================================
    // Handle logout button in public services modal when user is logged in via SSO
    const publicModal = document.getElementById('publicModal');
    
    if (publicModal) {
        publicModal.addEventListener('click', function (e) {
            // Check if clicked element is or contains btnLogoutPublic
            const logoutBtn = e.target.closest('#btnLogoutPublic');
            
            if (logoutBtn) {
                e.preventDefault();
                
                // Clear all SSO-related localStorage
                localStorage.removeItem('admAccessToken');
                localStorage.removeItem('admJabatan');
                localStorage.removeItem('admServiceAccessToken');
                localStorage.removeItem('admServiceJabatan');
                localStorage.removeItem('pubAccessToken');
                localStorage.removeItem('pubJabatan');
                localStorage.removeItem('pubUserName');
                localStorage.removeItem('sso_session');
                
                console.log('✓ Public Modal Logout: SSO session cleared, redirecting to logout...');
                
                // Redirect to SSO logout to clear server session
                window.location.href = '/sso/logout';
            }
        });
    }

    // ============================================
    // PUBLIC MODAL APP LINK HANDLER
    // ============================================
    // Handle clicks on public service app links to open apps (direct, iframe, epresence)
    const pubAppLinks = document.querySelectorAll('.pub-app-link');
    
    pubAppLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            
            const appType = this.getAttribute('data-app-type');
            const appTarget = this.getAttribute('data-app-target');
            const appName = this.getAttribute('title') || 'Service';
            
            // Retrieve access token if available (from SSO session)
            const accessToken = localStorage.getItem('pubAccessToken') || localStorage.getItem('admAccessToken') || '';
            
            console.log(`🔗 Public Service clicked: ${appName} (Type: ${appType})`);
            console.log(`  - Target: ${appTarget}`);
            console.log(`  - Token available: ${accessToken ? 'Yes' : 'No'}`);
            
            if (appType === 'direct') {
                // Direct link - open in new tab without token
                console.log(`🌐 Opening DIRECT in new tab: ${appTarget}`);
                window.open(appTarget, '_blank');
            } 
            else if (appType === 'epresence') {
                // E-Presence - open in new tab with access token
                let openUrl = appTarget.includes('?')
                    ? appTarget + '&access_token=' + accessToken
                    : appTarget + '?access_token=' + accessToken;
                console.log(`🌐 Opening EPRESENCE in new tab with token: ${openUrl}`);
                window.open(openUrl, '_blank');
            }
            else if (appType === 'iframe') {
                // Iframe - open in modal with access token
                let iframeUrl = appTarget.includes('?')
                    ? appTarget + '&access_token=' + accessToken
                    : appTarget + '?access_token=' + accessToken;
                console.log(`📄 Opening IFRAME: ${iframeUrl}`);
                // Navigate to service page with iframe
                window.location.href = '{{ route("web.public-services") }}?url=' + encodeURIComponent(iframeUrl) + '&name=' + encodeURIComponent(appName) + '&token=' + encodeURIComponent(accessToken);
            }
        });
    });
});

// ============================================
// MOBILE LAYOUT EVENT HANDLERS
// ============================================
document.addEventListener('DOMContentLoaded', function () {
    // Mobile layout setup
    const isMobile = window.innerWidth <= 480;
    const desktopMain = document.querySelector('.desktop-main');
    const mobileMain = document.querySelector('.mobile-main');

    // Function to toggle between desktop and mobile layout
    function updateLayout() {
        const isMobile = window.innerWidth <= 480;
        
        if (isMobile) {
            if (desktopMain) desktopMain.style.display = 'none';
            if (mobileMain) mobileMain.style.display = 'flex';
        } else {
            if (desktopMain) desktopMain.style.display = '';
            if (mobileMain) mobileMain.style.display = 'none';
        }
    }

    // Initial layout setup
    updateLayout();

    // Update layout on window resize
    window.addEventListener('resize', updateLayout);

    // Mobile service button handlers
    const layananPublikMobileBtn = document.getElementById('layanan-publik-mobile');
    const admPemerintahMobileBtn = document.getElementById('adm-pemerintah-mobile');
    const mallDataMobileBtn = document.getElementById('mall-data-mobile');

    if (layananPublikMobileBtn) {
        layananPublikMobileBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const publicModal = document.getElementById('publicModal');
            if (publicModal) {
                publicModal.style.display = 'flex';
                setTimeout(() => {
                    publicModal.classList.add('show');
                }, 10);
            }
        });
    }

    if (admPemerintahMobileBtn) {
        admPemerintahMobileBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const admModal = document.getElementById('admModal');
            if (admModal) {
                admModal.style.display = 'flex';
                setTimeout(() => {
                    admModal.classList.add('show');
                }, 10);
            }
        });
    }

    if (mallDataMobileBtn) {
        mallDataMobileBtn.addEventListener('click', function (e) {
            e.preventDefault();
            // Navigate to mall data informasi route
            const route = this.getAttribute('data-route');
            if (route) {
                window.location.href = route;
            }
        });
    }

    // Mobile live chat button - ensure it works on mobile
    const liveChatBtn = document.getElementById('liveChatBtn');
    if (liveChatBtn) {
        liveChatBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const liveChatModal = document.getElementById('liveChatModal');
            if (liveChatModal) {
                liveChatModal.style.display = 'flex';
                setTimeout(() => {
                    liveChatModal.classList.add('show');
                }, 10);
            }
        });
    }

    // Mobile Apps Carousel Pagination
    const mobileAppsContainer = document.getElementById('mobileAppsContainer');
    const paginationDots = document.querySelectorAll('.mobile-apps-pagination .dot');
    
    if (mobileAppsContainer && paginationDots.length > 0) {
        // Handle scroll event to update active pagination dot
        mobileAppsContainer.addEventListener('scroll', function() {
            const scrollLeft = mobileAppsContainer.scrollLeft;
            const containerWidth = mobileAppsContainer.offsetWidth;
            
            // Calculate which page is visible (each row is approximately one page width)
            const pageIndex = Math.round(scrollLeft / containerWidth);
            
            // Update active dot
            paginationDots.forEach((dot, index) => {
                if (index === pageIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        });

        // Handle pagination dot clicks
        paginationDots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                const scrollPosition = index * mobileAppsContainer.offsetWidth;
                mobileAppsContainer.scrollTo({
                    left: scrollPosition,
                    behavior: 'smooth'
                });
            });
        });
    }
});
