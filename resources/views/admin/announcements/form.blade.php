@extends('admin.announcements.layout')

@section('title', $announcement->exists ? 'Edit pengumuman' : 'Tambah pengumuman')

@section('content')
    @php
        $documentSource = old('document_source', $announcement->pdf_url ? 'url' : 'file');
        $needsPdfFile = !$announcement->exists || !$announcement->pdf_path;
    @endphp
    <a href="{{ route('admin.announcements.index') }}" class="text-link back-link"><span aria-hidden="true">←</span> Daftar pengumuman</a>
    <div class="page-heading form-page-heading"><div><span class="eyebrow">KELOLA KONTEN</span><h1>{{ $announcement->exists ? 'Edit pengumuman' : 'Tambah pengumuman' }}</h1><p>Siapkan pesan popup dan dokumen PDF untuk pengunjung website.</p></div></div>

    @if($errors->any())
        <div class="notice notice-error" role="alert"><div><strong>Pengumuman belum dapat disimpan.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>
    @endif

    <form method="POST" action="{{ $announcement->exists ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" enctype="multipart/form-data" class="announcement-form">
        @csrf
        @if($announcement->exists) @method('PUT') @endif
        <div class="form-grid">
            <div class="form-primary">
                <section class="panel form-panel" aria-labelledby="content-title">
                    <div class="panel-heading"><div><h2 id="content-title">Isi pengumuman</h2><p>Teks yang akan dibaca pengunjung pada popup.</p></div><span class="step-label">01</span></div>
                    <div class="panel-body">
                        <div class="field">
                            <label for="title">Judul pengumuman <span class="required-mark">*</span></label>
                            <input id="title" name="title" type="text" value="{{ old('title', $announcement->title) }}" maxlength="200" required placeholder="Contoh: Hasil Tiga Besar Seleksi Terbuka Sekda" @error('title') aria-invalid="true" aria-describedby="title-error" @enderror>
                            @error('title')<p class="field-error" id="title-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="subtitle">Subjudul <span class="optional-label">Opsional</span></label>
                            <input id="subtitle" name="subtitle" type="text" value="{{ old('subtitle', $announcement->subtitle) }}" maxlength="500" placeholder="Contoh: Pemerintah Kabupaten Nunukan Tahun 2026" @error('subtitle') aria-invalid="true" aria-describedby="subtitle-error" @enderror>
                            @error('subtitle')<p class="field-error" id="subtitle-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="message">Pesan pengumuman <span class="optional-label">Opsional</span></label>
                            <textarea id="message" name="message" rows="6" maxlength="3000" placeholder="Tuliskan ringkasan pengumuman dan ajakan untuk membaca dokumen selengkapnya." aria-describedby="message-help{{ $errors->has('message') ? ' message-error' : '' }}" @error('message') aria-invalid="true" @enderror>{{ old('message', $announcement->message) }}</textarea>
                            <p class="field-help" id="message-help">Maksimal 3.000 karakter. Baris baru akan ditampilkan pada popup.</p>
                            @error('message')<p class="field-error" id="message-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field-row">
                            <div class="field">
                                <label for="reference_number">Nomor pengumuman <span class="optional-label">Opsional</span></label>
                                <input id="reference_number" name="reference_number" type="text" value="{{ old('reference_number', $announcement->reference_number) }}" maxlength="150" placeholder="Contoh: 16/PANSEL/2026" @error('reference_number') aria-invalid="true" aria-describedby="reference_number-error" @enderror>
                                @error('reference_number')<p class="field-error" id="reference_number-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label for="published_on">Tanggal pengumuman <span class="optional-label">Opsional</span></label>
                                <input id="published_on" name="published_on" type="date" value="{{ old('published_on', $announcement->published_on?->format('Y-m-d')) }}" @error('published_on') aria-invalid="true" aria-describedby="published_on-error" @enderror>
                                @error('published_on')<p class="field-error" id="published_on-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel form-panel" aria-labelledby="document-title">
                    <div class="panel-heading"><div><h2 id="document-title">Dokumen PDF</h2><p>Dokumen lengkap yang dibuka dari popup dan QR code.</p></div><span class="step-label">02</span></div>
                    <div class="panel-body">
                        @if($announcement->exists)
                            <div class="existing-document"><div class="document-symbol" aria-hidden="true">PDF</div><div><span class="field-help">Dokumen saat ini</span><strong>{{ $announcement->pdf_file_name ?: 'PDF dari tautan' }}</strong><a href="{{ route('admin.announcements.preview', $announcement) }}" target="_blank" rel="noopener" class="text-link">Lihat PDF <span aria-hidden="true">↗</span></a></div></div>
                        @endif
                        <div class="field">
                            <label for="document_source">Sumber dokumen <span class="required-mark">*</span></label>
                            <select id="document_source" name="document_source" required @error('document_source') aria-invalid="true" aria-describedby="document_source-error" @enderror>
                                <option value="file" @selected($documentSource === 'file')>Unggah PDF</option>
                                <option value="url" @selected($documentSource === 'url')>Tautan PDF</option>
                            </select>
                            @error('document_source')<p class="field-error" id="document_source-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field" id="pdf-file-field" @if($documentSource === 'url') hidden @endif>
                            <label for="pdf">{{ $announcement->exists && $announcement->pdf_path ? 'Ganti dokumen PDF' : 'Unggah dokumen PDF' }} @if($needsPdfFile)<span class="required-mark">*</span>@else<span class="optional-label">Opsional</span>@endif</label>
                            <div class="upload-area"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M12 16V3m-5 5 5-5 5 5M4 15v5a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-5"/></svg><input type="file" id="pdf" name="pdf" accept="application/pdf,.pdf" data-required="{{ $needsPdfFile ? 'true' : 'false' }}" @required($needsPdfFile && $documentSource === 'file') aria-describedby="pdf-help pdf-selection{{ $errors->has('pdf') ? ' pdf-error' : '' }}" @error('pdf') aria-invalid="true" @enderror><span id="pdf-selection" class="field-help">Belum ada file dipilih</span></div>
                            <p class="field-help" id="pdf-help">Format PDF, maksimal 20 MB. {{ $needsPdfFile ? 'Pilih dokumen sebelum menyimpan pengumuman.' : 'Kosongkan jika dokumen tidak diganti.' }}</p>
                            @error('pdf')<p class="field-error" id="pdf-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field" id="pdf-url-field" @if($documentSource !== 'url') hidden @endif>
                            <label for="pdf_url">Tautan PDF <span class="required-mark">*</span></label>
                            <input id="pdf_url" name="pdf_url" type="url" inputmode="url" value="{{ old('pdf_url', $announcement->pdf_url) }}" maxlength="2048" @required($documentSource === 'url') placeholder="https://contoh.go.id/dokumen/pengumuman.pdf" aria-describedby="pdf_url-help{{ $errors->has('pdf_url') ? ' pdf_url-error' : '' }}" @error('pdf_url') aria-invalid="true" @enderror>
                            <p class="field-help" id="pdf_url-help">Gunakan tautan HTTP atau HTTPS yang langsung membuka dokumen PDF.</p>
                            @error('pdf_url')<p class="field-error" id="pdf_url-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>
            </div>

            <aside class="form-secondary">
                <section class="panel form-panel" aria-labelledby="publish-title">
                    <div class="panel-heading"><div><h2 id="publish-title">Penayangan</h2><p>Atur status dan jadwal popup.</p></div><span class="step-label">03</span></div>
                    <div class="panel-body">
                        <input type="hidden" name="is_active" value="0">
                        <label class="activation-control" for="is_active"><span><strong>Aktifkan pengumuman</strong><small>Tampilkan sesuai jadwal di bawah.</small></span><input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', (bool) $announcement->is_active)) @error('is_active') aria-invalid="true" aria-describedby="is_active-error" @enderror></label>
                        @error('is_active')<p class="field-error" id="is_active-error">{{ $message }}</p>@enderror
                        <div class="form-divider"></div>
                        <div class="field">
                            <label for="starts_at">Mulai tayang <span class="optional-label">WITA</span></label>
                            <input id="starts_at" name="starts_at" type="datetime-local" value="{{ old('starts_at', $announcement->starts_at?->copy()->timezone('Asia/Makassar')->format('Y-m-d\TH:i')) }}" aria-describedby="starts_at-help{{ $errors->has('starts_at') ? ' starts_at-error' : '' }}" @error('starts_at') aria-invalid="true" @enderror>
                            <p class="field-help" id="starts_at-help">Kosongkan untuk langsung tayang saat aktif.</p>
                            @error('starts_at')<p class="field-error" id="starts_at-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="ends_at">Selesai tayang <span class="optional-label">WITA</span></label>
                            <input id="ends_at" name="ends_at" type="datetime-local" value="{{ old('ends_at', $announcement->ends_at?->copy()->timezone('Asia/Makassar')->format('Y-m-d\TH:i')) }}" aria-describedby="ends_at-help{{ $errors->has('ends_at') ? ' ends_at-error' : '' }}" @error('ends_at') aria-invalid="true" @enderror>
                            <p class="field-help" id="ends_at-help">Kosongkan untuk tayang tanpa batas akhir.</p>
                            @error('ends_at')<p class="field-error" id="ends_at-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="inline-note">Jika beberapa pengumuman aktif bersamaan, popup menampilkan pengumuman yang paling baru diperbarui.</div>
                    </div>
                </section>

                <section class="panel form-panel share-panel" aria-labelledby="share-title"><div class="panel-body"><span class="eyebrow">BAGIKAN DOKUMEN</span><h2 id="share-title">QR code otomatis</h2><p>QR code mengarah ke preview PDF pengumuman. Unduh setelah pengumuman disimpan.</p>
                    <input type="hidden" name="show_qr" value="0">
                    <label class="checkbox-label qr-checkbox"><input type="checkbox" name="show_qr" value="1" @checked(old('show_qr', $announcement->exists ? (bool) $announcement->show_qr : true)) @error('show_qr') aria-invalid="true" aria-describedby="show_qr-error" @enderror><span>Tampilkan QR code di popup</span></label>
                    @error('show_qr')<p class="field-error" id="show_qr-error">{{ $message }}</p>@enderror
                    @if($announcement->exists)<a href="{{ route('admin.announcements.qr', $announcement) }}" class="button button-secondary button-full">Unduh QR code <span aria-hidden="true">↓</span></a>@endif
                    <p class="field-help">Tautan publik dan QR hanya dapat dibuka saat pengumuman aktif dalam jadwal tayangnya. Admin tetap dapat melihat PDF melalui tombol preview.</p>
                </div></section>
            </aside>
        </div>
        <div class="form-actions"><span class="field-help"><span class="required-mark">*</span> Wajib diisi</span><div><a href="{{ route('admin.announcements.index') }}" class="button button-secondary">Batal</a><button type="submit" class="button button-primary">{{ $announcement->exists ? 'Simpan perubahan' : 'Simpan pengumuman' }}</button></div></div>
    </form>
@endsection
