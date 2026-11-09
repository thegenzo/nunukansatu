# Dashboard pengumuman popup

Dashboard tersedia di `/admin/pengumuman`, dengan login di `/admin/login`.
Pengelolaan berikutnya dilakukan dari dashboard tanpa mengedit Blade.

## Persiapan satu kali di server

Gunakan database aplikasi yang sudah dikonfigurasi dalam `.env`. Pada instalasi
Laravel baru, jalankan migrasi aplikasi seperti biasa (`php artisan migrate --force`).
Jika database lama dikelola secara manual dan tabel `users` sudah tersedia,
jalankan hanya migrasi fitur ini:

```sh
php artisan migrate --path=database/migrations/2026_10_28_000001_create_announcement_admins_table.php --path=database/migrations/2026_10_28_000002_create_announcements_table.php --path=database/migrations/2026_11_09_000001_move_announcement_admins_to_users.php --force
php artisan announcements:admin
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Perintah `announcements:admin` meminta nama, email, dan kata sandi minimal 12 karakter.
Kata sandi dimasukkan secara tersembunyi dan disimpan sebagai hash. Tidak ada akun
atau kata sandi bawaan. Jalankan lagi dengan email yang sama untuk mengganti kata
sandi; sesi admin dengan kata sandi lama akan diminta masuk kembali. Perintah ini
menyimpan atau memperbarui akun di tabel `users` dan memberikan hak `is_admin`.
Jika email sudah dimiliki pengguna, akun tersebut yang diperbarui; NIK, nomor
telepon, dan status verifikasi publiknya dipertahankan.

Semua autentikasi dashboard memakai model `User`, provider `users`, dan guard
`web`. Pengguna biasa tetap tidak dapat masuk ke dashboard: hanya `is_admin=true`
yang diberi akses. Pendaftaran publik tidak dapat menetapkan hak admin. NIK dan
nomor telepon menjadi nullable untuk akun admin yang dibuat melalui email;
nomor telepon yang terisi tetap unik. Alur SSO pegawai yang sudah ada tetap berlaku.

Migrasi tanggal 9 November 2026 memindahkan seluruh akun `announcement_admins`
ke `users` beserta hash kata sandinya, memverifikasi hasil pemindahan, kemudian
menghapus tabel lama. Akun dengan email dan hash identik digabung tanpa mengubah
profil publiknya. Jika email sama tetapi kredensial berbeda, migrasi berhenti
agar tidak menimpa akun; konflik harus diselesaikan terlebih dahulu. Setelah
pembaruan, admin masuk kembali dengan email dan kata sandi sebelumnya. Rollback
memulihkan tabel lama dari pengguna admin dan tetap mempertahankan data `users`.

Pastikan `APP_URL=https://nunukankab.go.id` pada server produksi. QR memakai alamat
ini agar tautan tetap menuju domain resmi meskipun dibuat dari alamat lain.
Untuk pengujian lokal gunakan URL lokal aplikasi. Setelah mengubah `.env`, jalankan
`php artisan config:clear` atau buat kembali cache konfigurasi sesuai proses deploy.

Cookie session secara default mengikuti host yang sedang diakses. Biarkan
`SESSION_DOMAIN=null` (atau tidak diisi) agar login bekerja pada localhost maupun
domain produksi. Jika session memang perlu dibagikan ke subdomain, isi domain
produksi yang sesuai melalui `SESSION_DOMAIN`; jangan gunakan domain produksi
pada lingkungan lokal. Setelah mengubah konfigurasi, jalankan `php artisan config:clear`
dan muat ulang halaman login sebelum mengirim form kembali.

Folder `storage/` dan `bootstrap/cache/` harus dapat ditulis aplikasi. File unggahan
disimpan pada `storage/app/announcements/`; file ditayangkan melalui route preview,
sehingga fitur ini tidak memerlukan symlink `storage:link`. Pada PHP server, atur
`upload_max_filesize` setidaknya `20M` dan `post_max_size` setidaknya `24M` untuk
mengizinkan batas unggah aplikasi sebesar 20 MB. Batas request web server harus
mendukung ukuran yang sama. Database dan folder unggahan perlu dicadangkan bersama.

## Mengelola pengumuman

1. Buka `/admin/login` dan masuk menggunakan akun yang dibuat melalui perintah tadi.
2. Klik **Tambah pengumuman**. Isi judul, serta subjudul, pesan, nomor, dan tanggal
   bila diperlukan. Pesan mendukung baris baru dan ditampilkan sebagai teks biasa.
3. Pilih **Unggah PDF** (maksimal 20 MB) atau **Tautan PDF** menggunakan HTTP/HTTPS.
   Tautan eksternal harus dapat dibuka pengunjung tanpa login. Ketersediaan dan
   dukungan preview dokumen eksternal bergantung pada penyedia file dan browser.
4. Centang **Aktifkan pengumuman** untuk menayangkannya. Atur jadwal bila diperlukan.
   Semua waktu yang dimasukkan dan ditampilkan di dashboard memakai WITA.
   Mulai kosong berarti langsung, selesai kosong berarti tanpa batas akhir.
   Pada waktu selesai, pengumuman tidak lagi tampil.
5. Pilih apakah QR ditampilkan di popup, kemudian simpan. Jika beberapa pengumuman
   aktif dalam jadwal yang sama, beranda menampilkan satu yang terakhir diperbarui.
6. Gunakan **Edit**, **PDF**, **QR**, atau **Hapus** dari daftar. Hapus meminta
   konfirmasi. Untuk menyembunyikan pengumuman tanpa menghapus, edit dan hilangkan
   centang aktif.

QR diunduh sebagai SVG, sehingga tetap tajam saat dicetak. Tautannya memakai ID
tetap: perubahan teks atau penggantian PDF tidak mengharuskan mencetak ulang QR.
Tautan publik, PDF unggahan, dan QR publik hanya tersedia selama pengumuman aktif
sesuai jadwal. Admin dapat melakukan preview termasuk untuk draft/nonaktif.
Jika browser tidak menampilkan PDF di dalam halaman, gunakan tombol **Buka PDF**.

Migrasi memasukkan pengumuman hasil tiga besar Sekda tahun 2026 yang sebelumnya
ditulis di Blade sebagai data awal. Tautan CDN dan pengaturan QR tersembunyi yang
sudah ada dipertahankan. File lama di folder publik tetap disimpan; penghapusan
melalui dashboard hanya menghapus unggahan yang dimiliki fitur pengumuman.

## Pengujian

```sh
php artisan test
```

Tes menggunakan SQLite dalam memori dan disk unggahan palsu. Database dan dokumen
aplikasi tidak dipakai sebagai data tes. Cakupan meliputi autentikasi admin,
CRUD, validasi PDF/URL, pembersihan file, jadwal WITA, preview publik, QR, serta
pencabutan sesi setelah reset kata sandi, pembatasan hak pengguna publik, serta
pemindahan akun lama tanpa kehilangan hash kata sandi dan relasi pengguna.
