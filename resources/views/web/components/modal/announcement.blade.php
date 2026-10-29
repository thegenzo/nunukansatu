<div id="pengumumanJptModal" class="modal-overlay pengumuman-jpt-overlay" role="dialog" aria-modal="true" aria-labelledby="pengumumanJptTitle">
    <div class="modal-content pengumuman-jpt-content">
        <button type="button" class="close-modal btn btn-sm btn-danger px-3 pengumuman-jpt-close" aria-label="Tutup pengumuman">
            <i class="bi bi-x" aria-hidden="true"></i>
            <span>Tutup</span>
        </button>
        <div class="pengumuman-jpt-body">
            <div class="pengumuman-jpt-badge">Pengumuman</div>
            <h2 id="pengumumanJptTitle">{{ $announcement->title }}</h2>
            @if($announcement->subtitle)
                <p class="pengumuman-jpt-subtitle">{{ $announcement->subtitle }}</p>
            @endif
            @if($announcement->reference_number || $announcement->published_on)
                <p class="pengumuman-jpt-detail">
                    @if($announcement->reference_number)Nomor: {{ $announcement->reference_number }}<br>@endif
                    @if($announcement->published_on){{ $announcement->published_on->locale('id')->translatedFormat('d F Y') }}@endif
                </p>
            @endif
            @if($announcement->message)
                <p class="pengumuman-jpt-detail pengumuman-jpt-message">{{ $announcement->message }}</p>
            @endif
            <p class="pengumuman-jpt-cta">
                <a href="{{ route('web.announcements.show', $announcement) }}" target="_blank" rel="noopener noreferrer">Lihat Pengumuman (PDF)</a>
            </p>
            @if($announcement->show_qr)
                <figure class="pengumuman-jpt-qr">
                    <img src="{{ route('web.announcements.qr', $announcement) }}" width="220" height="220" alt="QR code untuk membuka preview PDF pengumuman">
                    <figcaption>Pindai QR code untuk membuka pengumuman di ponsel.</figcaption>
                </figure>
                <a href="{{ route('web.announcements.qr', $announcement) }}" download="qr-pengumuman.svg" class="btn btn-outline-danger btn-sm">Unduh QR Code</a>
            @endif
        </div>
    </div>
</div>
