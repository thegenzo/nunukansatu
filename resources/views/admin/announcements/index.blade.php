@extends('admin.announcements.layout')

@section('title', 'Pengumuman popup')

@section('content')
    <div class="page-heading">
        <div><span class="eyebrow">KELOLA KONTEN</span><h1>Pengumuman popup</h1><p>Kelola informasi dan dokumen yang tampil di beranda website.</p></div>
        <a href="{{ route('admin.announcements.create') }}" class="button button-primary"><span class="plus-icon" aria-hidden="true">+</span> Tambah pengumuman</a>
    </div>

    <div class="stats-grid" aria-label="Ringkasan pengumuman">
        <div class="stat-card"><span class="stat-label">Total pengumuman</span><strong>{{ $stats['total'] }}</strong><span class="stat-caption">Seluruh pengumuman tersimpan</span></div>
        <div class="stat-card"><span class="stat-label"><span class="status-dot green"></span> Aktif sesuai jadwal</span><strong>{{ $stats['active'] }}</strong><span class="stat-caption">Siap ditampilkan di beranda</span></div>
        <div class="stat-card"><span class="stat-label"><span class="status-dot amber"></span> Terjadwal</span><strong>{{ $stats['scheduled'] }}</strong><span class="stat-caption">Menunggu waktu mulai tayang</span></div>
    </div>

    <div class="notice notice-info">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 11v6M12 7v1"/></svg>
        <span>Jika ada beberapa pengumuman aktif, beranda menampilkan <strong>pengumuman yang paling baru diperbarui</strong>. Semua jadwal menggunakan waktu WITA.</span>
    </div>

    <section class="panel announcement-list" aria-labelledby="list-title">
        <div class="panel-heading"><div><h2 id="list-title">Daftar pengumuman</h2><p>{{ $announcements->total() }} pengumuman</p></div><span class="label-soft">Popup beranda</span></div>
        @if($announcements->count())
            <div class="table-scroll" tabindex="0" role="region" aria-label="Tabel pengumuman; geser ke samping untuk melihat seluruh kolom">
                <table class="announcement-table">
                    <thead><tr><th scope="col">Pengumuman</th><th scope="col">Status</th><th scope="col">Jadwal tayang <span class="th-detail">WITA</span></th><th scope="col">Diperbarui</th><th scope="col" class="actions-column">Tindakan</th></tr></thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                            @php
                                $visible = $announcement->isCurrentlyVisible();
                                $scheduled = $announcement->is_active && $announcement->starts_at && $announcement->starts_at->isFuture();
                            @endphp
                            <tr>
                                <td class="announcement-title-cell"><a href="{{ route('admin.announcements.edit', $announcement) }}" class="announcement-title">{{ $announcement->title }}</a><div class="announcement-reference">{{ $announcement->reference_number ?: 'Tanpa nomor pengumuman' }}</div><div class="announcement-document">{{ $announcement->pdf_file_name ?: 'PDF dari tautan' }}</div></td>
                                <td>
                                    @if(!$announcement->is_active)<span class="badge badge-neutral"><span></span>Nonaktif</span>
                                    @elseif($visible)<span class="badge badge-success"><span></span>Aktif</span>
                                    @elseif($scheduled)<span class="badge badge-warning"><span></span>Terjadwal</span>
                                    @else<span class="badge badge-neutral"><span></span>Berakhir</span>@endif
                                </td>
                                <td class="schedule-cell">
                                    <span>{{ $announcement->starts_at ? $announcement->starts_at->copy()->timezone('Asia/Makassar')->format('d/m/Y H:i') : 'Mulai segera' }}</span>
                                    <small>{{ $announcement->ends_at ? 's.d. '.$announcement->ends_at->copy()->timezone('Asia/Makassar')->format('d/m/Y H:i') : 'Tanpa batas akhir' }}</small>
                                </td>
                                <td class="updated-cell">{{ $announcement->updated_at->copy()->timezone('Asia/Makassar')->format('d/m/Y') }}<small>{{ $announcement->updated_at->copy()->timezone('Asia/Makassar')->format('H:i') }} WITA</small></td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="button button-small button-secondary">Edit</a>
                                        <a href="{{ route('admin.announcements.preview', $announcement) }}" target="_blank" rel="noopener" class="button button-small button-quiet" aria-label="Preview PDF: {{ $announcement->title }}">PDF <span aria-hidden="true">↗</span></a>
                                        <a href="{{ route('admin.announcements.qr', $announcement) }}" class="button button-small button-quiet" aria-label="Unduh QR code: {{ $announcement->title }}">QR</a>
                                        <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" data-delete-announcement="{{ $announcement->title }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="button button-small button-danger" aria-label="Hapus pengumuman: {{ $announcement->title }}">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($announcements->hasPages())
                <nav class="pagination" aria-label="Halaman daftar pengumuman">
                    <p>Menampilkan {{ $announcements->firstItem() }}–{{ $announcements->lastItem() }} dari {{ $announcements->total() }}</p>
                    <div class="pagination-controls">
                        @if($announcements->onFirstPage())<span class="button button-secondary button-small is-disabled">← Sebelumnya</span>@else<a href="{{ $announcements->previousPageUrl() }}" class="button button-secondary button-small" rel="prev">← Sebelumnya</a>@endif
                        <span class="pagination-page">{{ $announcements->currentPage() }} / {{ $announcements->lastPage() }}</span>
                        @if($announcements->hasMorePages())<a href="{{ $announcements->nextPageUrl() }}" class="button button-secondary button-small" rel="next">Berikutnya →</a>@else<span class="button button-secondary button-small is-disabled">Berikutnya →</span>@endif
                    </div>
                </nav>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M3 10v4a2 2 0 0 0 2 2h3l10 4V4L8 8H5a2 2 0 0 0-2 2Z"/><path d="m8 16 1 5H6l-1-5M21 9v6"/></svg></div>
                <h3>Belum ada pengumuman</h3><p>Tambahkan judul, pesan, dan PDF pertama Anda.<br>QR code akan tersedia secara otomatis.</p>
                <a href="{{ route('admin.announcements.create') }}" class="button button-primary">Tambah pengumuman</a>
            </div>
        @endif
    </section>
@endsection
