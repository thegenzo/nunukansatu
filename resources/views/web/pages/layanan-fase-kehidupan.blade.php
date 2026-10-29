<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Fase Kehidupan - Nunukan Satu</title>
    <link rel="icon" href="{{ asset('assets/favnunukan.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: #212121;
            background: #f5f5f5;
        }

        /* Hero Section */ 
        .hero-section {
            background: linear-gradient(135deg, #D32F2F 0%, #8E0000 100%);
            padding: 60px 40px;
            min-height: 320px;
            display: flex;
            align-items: center;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-text {
            flex: 1;
            color: white;
        }

        .hero-text h1 {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 16px;
        }

        .hero-text p {
            font-size: 1.1rem;
            font-weight: 400;
            opacity: 0.9;
            line-height: 1.6;
            max-width: 560px;
        }

        .hero-logo {
            flex-shrink: 0;
        }

        .hero-logo img {
            height: 120px;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
        }

        /* Content Section */
        .content-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 40px 64px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212121;
            margin-bottom: 8px;
        }

        .section-subtitle {
            font-size: 0.95rem;
            color: #757575;
            margin-bottom: 32px;
        }

        .fase-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .fase-card {
            background: white;
            border-radius: 16px;
            padding: 28px 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 2px solid transparent;
        }

        .fase-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(211, 47, 47, 0.15);
            border-color: #D32F2F;
        }

        .fase-card-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #D32F2F, #8E0000);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .fase-card-icon i {
            font-size: 1.6rem;
            color: white;
        }

        .fase-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #212121;
            margin-bottom: 8px;
        }

        .fase-card p {
            font-size: 0.875rem;
            color: #757575;
            line-height: 1.5;
            margin: 0;
        }

        /* Coming Soon Modal */
        .coming-soon-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .coming-soon-overlay.active {
            display: flex;
        }

        .coming-soon-modal {
            background: white;
            border-radius: 16px;
            padding: 40px 32px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
        }

        .coming-soon-modal-icon {
            width: 72px;
            height: 72px;
            background: #FFEBEE;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .coming-soon-modal-icon i {
            font-size: 2rem;
            color: #D32F2F;
        }

        .coming-soon-modal h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #212121;
            margin-bottom: 8px;
        }

        .coming-soon-modal p {
            font-size: 0.9rem;
            color: #757575;
            margin-bottom: 24px;
        }

        .coming-soon-modal-btn {
            background: #D32F2F;
            color: white;
            border: none;
            padding: 10px 32px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .coming-soon-modal-btn:hover {
            background: #A6160F;
        }

        @media (max-width: 992px) {
            .fase-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 24px;
                min-height: auto;
            }

            .hero-content {
                flex-direction: column-reverse;
                text-align: center;
                gap: 24px;
            }

            .hero-text h1 {
                font-size: 1.6rem;
            }

            .hero-text p {
                font-size: 1rem;
            }

            .hero-logo img {
                height: 80px;
            }

            .content-section {
                padding: 32px 20px 48px;
            }

            .fase-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Menemani Setiap Langkah Perjalanan Hidup Anda</h1>
                <p>Komitmen kami untuk selalu hadir di setiap momen penting dalam kehidupan Anda.</p>
            </div>
            <div class="hero-logo">
                <img src="{{ asset('web-assets/assets/img/nunukansatu-logo-white.png') }}" alt="Nunukan Satu Logo">
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <h2 class="section-title">Layanan Fase Kehidupan</h2>
        <p class="section-subtitle">Memberikan pelayanan di setiap langkah hidup Anda</p>

        <div class="fase-grid">
            <div class="fase-card" data-service="Kelahiran">
                <div class="fase-card-icon"><i class="bi bi-heart-pulse"></i></div>
                <h3>Kelahiran</h3>
                <p>Dapatkan informasi seputar layanan kelahiran dari pendaftaran hingga dokumen penting untuk kenyamanan Anda dan keluarga.</p>
            </div>
            <div class="fase-card" data-service="Sekolah">
                <div class="fase-card-icon"><i class="bi bi-mortarboard"></i></div>
                <h3>Sekolah</h3>
                <p>Temukan informasi pendidikan anak usia dini juga pilihan sekolah dasar, menengah, dan atas sesuai kriteria yang Anda cari.</p>
            </div>
            <div class="fase-card" data-service="Pelatihan & Sertifikasi">
                <div class="fase-card-icon"><i class="bi bi-award"></i></div>
                <h3>Pelatihan & Sertifikasi</h3>
                <p>Dapatkan informasi seputar ragam pelatihan dan sertifikasi yang sudah diakui untuk menunjang karier Anda.</p>
            </div>
            <div class="fase-card" data-service="Membangun Usaha">
                <div class="fase-card-icon"><i class="bi bi-shop"></i></div>
                <h3>Membangun Usaha</h3>
                <p>Mulai bisnis Anda dengan langkah yang tepat melalui ragam panduan dan dukungan dalam membangun usaha dari nol.</p>
            </div>
            <div class="fase-card" data-service="Mendapatkan Hunian">
                <div class="fase-card-icon"><i class="bi bi-house"></i></div>
                <h3>Mendapatkan Hunian</h3>
                <p>Dapatkan informasi lengkap tentang ragam layanan yang membantu Anda untuk mendapatkan hunian impian.</p>
            </div>
            <div class="fase-card" data-service="Kegiatan Bermasyarakat">
                <div class="fase-card-icon"><i class="bi bi-people"></i></div>
                <h3>Kegiatan Bermasyarakat</h3>
                <p>Temukan ragam pilihan kegiatan sosial yang bisa Anda ikuti untuk berkontribusi ke masyarakat.</p>
            </div>
            <div class="fase-card" data-service="Kesehatan">
                <div class="fase-card-icon"><i class="bi bi-hospital"></i></div>
                <h3>Kesehatan</h3>
                <p>Akses informasi layanan kesehatan, fasilitas medis, dan program kesehatan masyarakat di Kabupaten Nunukan.</p>
            </div>
            <div class="fase-card" data-service="Pendidikan">
                <div class="fase-card-icon"><i class="bi bi-book"></i></div>
                <h3>Pendidikan</h3>
                <p>Informasi program pendidikan, beasiswa, dan layanan terkait pendidikan di seluruh jenjang.</p>
            </div>
            <div class="fase-card" data-service="Tanggap Darurat">
                <div class="fase-card-icon"><i class="bi bi-exclamation-triangle"></i></div>
                <h3>Tanggap Darurat</h3>
                <p>Informasi layanan tanggap darurat bencana, nomor hotline, dan prosedur evakuasi keadaan darurat.</p>
            </div>
            <div class="fase-card" data-service="Sosial dan Hukum">
                <div class="fase-card-icon"><i class="bi bi-shield-check"></i></div>
                <h3>Sosial dan Hukum</h3>
                <p>Layanan bantuan sosial, perlindungan hukum, dan informasi terkait kesejahteraan masyarakat.</p>
            </div>
            <div class="fase-card" data-service="Hari Tua">
                <div class="fase-card-icon"><i class="bi bi-person-hearts"></i></div>
                <h3>Hari Tua</h3>
                <p>Informasi layanan dan program untuk lansia, termasuk kesehatan, kesejahteraan, dan aktivitas positif.</p>
            </div>
            <div class="fase-card" data-service="Rekreasi">
                <div class="fase-card-icon"><i class="bi bi-tree"></i></div>
                <h3>Rekreasi</h3>
                <p>Temukan destinasi wisata, taman, dan fasilitas rekreasi untuk refreshing bersama keluarga.</p>
            </div>
            <div class="fase-card" data-service="Layanan Kependudukan">
                <div class="fase-card-icon"><i class="bi bi-person-vcard"></i></div>
                <h3>Layanan Kependudukan</h3>
                <p>Informasi mengenai syarat dan tata cara mendapatkan layanan kependudukan di Kabupaten Nunukan.</p>
            </div>
            <div class="fase-card" data-service="Perizinan Usaha">
                <div class="fase-card-icon"><i class="bi bi-briefcase"></i></div>
                <h3>Perizinan Usaha</h3>
                <p>Layanan informasi dan kepengurusan perizinan usaha.</p>
            </div>
            <div class="fase-card" data-service="Info Wisata">
                <div class="fase-card-icon"><i class="bi bi-geo-alt"></i></div>
                <h3>Info Wisata</h3>
                <p>Temukan informasi mengenai destinasi wisata yang wajib dikunjungi di Kabupaten Nunukan.</p>
            </div>
            <div class="fase-card" data-service="Pajak Kendaraan Bermotor">
                <div class="fase-card-icon"><i class="bi bi-car-front"></i></div>
                <h3>Pajak Kendaraan Bermotor (PKB)</h3>
                <p>Informasi dan layanan mengenai Pajak Kendaraan Bermotor (PKB).</p>
            </div>
            <div class="fase-card" data-service="Pengajuan Sertifikasi Halal">
                <div class="fase-card-icon"><i class="bi bi-patch-check"></i></div>
                <h3>Pengajuan Sertifikasi Halal</h3>
                <p>Informasi dan layanan mengenai pengajuan sertifikasi halal.</p>
            </div>
            <div class="fase-card" data-service="Bantuan Sosial">
                <div class="fase-card-icon"><i class="bi bi-heart"></i></div>
                <h3>Bantuan Sosial</h3>
                <p>Informasi program bantuan sosial yang diselenggarakan pemerintah daerah.</p>
            </div>
        </div>
    </section>

    <!-- Coming Soon Modal -->
    <div class="coming-soon-overlay" id="comingSoonOverlay">
        <div class="coming-soon-modal">
            <div class="coming-soon-modal-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <h3>Coming Soon</h3>
            <p>Layanan ini sedang dalam tahap pengembangan. Nantikan kehadirannya segera!</p>
            <button class="coming-soon-modal-btn" id="closeComingSoon">Mengerti</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const overlay = document.getElementById('comingSoonOverlay');
            const closeBtn = document.getElementById('closeComingSoon');

            document.querySelectorAll('.fase-card').forEach(function (card) {
                card.addEventListener('click', function () {
                    overlay.classList.add('active');
                });
            });

            closeBtn.addEventListener('click', function () {
                overlay.classList.remove('active');
            });

            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) {
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>
