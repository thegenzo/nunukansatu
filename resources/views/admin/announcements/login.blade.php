@extends('admin.announcements.layout')

@section('title', 'Masuk admin')

@section('content')
    <div class="login-shell">
        <section class="login-introduction" aria-labelledby="login-welcome">
            <a href="{{ route('web.home') }}" class="login-brand">
                <img src="{{ asset('web-assets/assets/img/nunukan-icon.png') }}" alt="" width="49" height="59">
                <span>PEMERINTAH KABUPATEN<strong>NUNUKAN</strong></span>
            </a>
            <div class="login-introduction-copy">
                <span class="eyebrow light">ADMINISTRASI WEBSITE</span>
                <h1 id="login-welcome">Informasi terbaru,<br>langsung ke masyarakat.</h1>
                <p>Kelola pengumuman di beranda, atur waktu tayang, dan bagikan dokumen melalui QR code dari satu tempat.</p>
                <div class="login-feature"><span aria-hidden="true">01</span> Tulis dan perbarui pengumuman</div>
                <div class="login-feature"><span aria-hidden="true">02</span> Unggah dokumen PDF</div>
                <div class="login-feature"><span aria-hidden="true">03</span> Atur jadwal dan bagikan QR code</div>
            </div>
            <div class="login-introduction-footer">Portal resmi Kabupaten Nunukan</div>
        </section>
        <section class="login-form-panel" aria-labelledby="login-title">
            <div class="login-form-content">
                <span class="eyebrow">SELAMAT DATANG KEMBALI</span>
                <h2 id="login-title">Masuk ke dashboard</h2>
                <p class="muted login-description">Gunakan akun administrator untuk mengelola pengumuman popup.</p>

                @if(session('status'))
                    <div class="notice notice-success" role="status">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="notice notice-error" role="alert">
                        <div><strong>Belum berhasil masuk.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" class="login-form">
                    @csrf
                    <div class="field">
                        <label for="email">Alamat email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" autofocus @error('email') aria-invalid="true" @enderror placeholder="admin@nunukankab.go.id">
                    </div>
                    <div class="field">
                        <label for="password">Kata sandi</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password" @error('password') aria-invalid="true" @enderror placeholder="Masukkan kata sandi">
                    </div>
                    <label class="checkbox-label login-remember"><input type="checkbox" name="remember" value="1" @checked(old('remember'))> <span>Ingat saya di perangkat ini</span></label>
                    <button type="submit" class="button button-primary button-full">Masuk ke dashboard <span aria-hidden="true">→</span></button>
                </form>
                <p class="login-help">Akses hanya untuk pengelola website. Hubungi administrator jika Anda membutuhkan akun.</p>
                <a href="{{ route('web.home') }}" class="text-link login-back"><span aria-hidden="true">←</span> Kembali ke website</a>
            </div>
        </section>
    </div>
@endsection
