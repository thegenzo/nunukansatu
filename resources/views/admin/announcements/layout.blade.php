<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="color-scheme" content="light">
    <title>@yield('title', 'Pengumuman') · Admin Nunukan</title>
    <link rel="icon" href="{{ asset('web-assets/assets/img/nunukan-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('web-assets/announcement-admin.css') }}">
</head>
<body class="announcement-admin {{ auth('web')->user()?->is_admin ? 'admin-authenticated' : 'admin-guest' }}">
    <a class="skip-link" href="#main-content">Lewati ke konten</a>

    @if(auth('web')->user()?->is_admin)
        <aside class="admin-sidebar" aria-label="Navigasi admin">
            <a href="{{ route('admin.announcements.index') }}" class="admin-brand">
                <img src="{{ asset('web-assets/assets/img/nunukan-icon.png') }}" alt="" width="39" height="47">
                <span><strong>Nunukansatu</strong><small>Administrasi website</small></span>
            </a>
            <div class="sidebar-section-label">KELOLA KONTEN</div>
            <nav>
                <a href="{{ route('admin.announcements.index') }}" class="sidebar-link" aria-current="page">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M3 10v4a2 2 0 0 0 2 2h3l10 4V4L8 8H5a2 2 0 0 0-2 2Z"/><path d="m8 16 1 5H6l-1-5M21 9v6"/></svg>
                    <span>Pengumuman Popup</span>
                </a>
            </nav>
            <div class="sidebar-bottom">
                <p>Portal Pemerintah<br><strong>Kabupaten Nunukan</strong></p>
                <a href="{{ route('web.home') }}" target="_blank" rel="noopener" class="sidebar-site-link">Buka website
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M14 3h7v7m0-7L10 14M10 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5"/></svg>
                </a>
            </div>
        </aside>
        <div class="admin-workspace">
            <header class="admin-topbar">
                <div class="topbar-context"><span class="status-dot"></span> Panel administrasi <span class="topbar-divider">/</span> Pengumuman</div>
                <div class="admin-account">
                    <span class="account-name">{{ auth('web')->user()->name ?: 'Administrator' }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="button button-quiet button-small">Keluar</button>
                    </form>
                </div>
            </header>
            <main id="main-content" class="admin-main" tabindex="-1">
                @if(session('success') || session('status'))
                    <div class="notice notice-success" role="status">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m8 12 3 3 5-6"/></svg>
                        <span>{{ session('success') ?: session('status') }}</span>
                    </div>
                @endif
                @yield('content')
                <footer class="admin-footer">Pemerintah Kabupaten Nunukan <span>Waktu penayangan menggunakan WITA (UTC+8).</span></footer>
            </main>
        </div>
    @else
        <main id="main-content" class="login-main" tabindex="-1">@yield('content')</main>
    @endif

    <script>
        document.querySelectorAll('[data-delete-announcement]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!window.confirm('Hapus pengumuman “' + form.dataset.deleteAnnouncement + '”? Pengumuman dan tautan preview ini tidak dapat diakses lagi.')) {
                    event.preventDefault();
                }
            });
        });
        var pdfInput = document.getElementById('pdf');
        var pdfLabel = document.getElementById('pdf-selection');
        if (pdfInput && pdfLabel) {
            pdfInput.addEventListener('change', function () {
                pdfLabel.textContent = pdfInput.files.length ? pdfInput.files[0].name : 'Belum ada file dipilih';
            });
        }
        var documentSource = document.getElementById('document_source');
        if (documentSource) {
            var urlInput = document.getElementById('pdf_url');
            var updateDocumentSource = function () {
                var useUrl = documentSource.value === 'url';
                document.getElementById('pdf-file-field').hidden = useUrl;
                document.getElementById('pdf-url-field').hidden = !useUrl;
                pdfInput.required = !useUrl && pdfInput.dataset.required === 'true';
                pdfInput.disabled = useUrl;
                urlInput.required = useUrl;
                urlInput.disabled = !useUrl;
            };
            documentSource.addEventListener('change', updateDocumentSource);
            updateDocumentSource();
        }
    </script>
</body>
</html>
