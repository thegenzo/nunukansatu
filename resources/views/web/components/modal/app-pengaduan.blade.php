<div id="chat-modal" class="custom-modal-pos" style=" display:none;">
  <div class="modal-content-customs">
    <a href="https://lapor.go.id" class="btn btn-cs mb-2" target="_blank">SP4N Lapor</a>
    <a href="https://satpolpp.nunukankab.go.id/" class="btn btn-cs mb-2" target="_blank">SILAPDAT</a>
    <a href="https://wbs.nunukankab.go.id" target="_blank">WBS</a> 
    <a href="https://forms.zohopublic.com/inspektoratnunukan1/form/PELAYANANKONSULTASI/formperma/zRe1jeiELo69ESPH80F4dfanVC72mD6XQS7BuBkNFY4" class="btn btn-cs mb-2" target="_blank"> Inspektorat</a>       
  </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatButton = document.querySelector('#chat-button');
        const modal = document.querySelector('#chat-modal');

        function isMobileDevice() {
            return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        }

        function toggleService() {
            if (modal) {
                modal.style.display = modal.style.display === "none" || modal.style.display === "" ? "block" : "none";
                if (chatButton) {
                    
                    if (modal.style.display === "block") {
                        chatButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.854 4.146a.5.5 0 0 1 0 .708L8.707 8l-3.853 3.854a.5.5 0 0 1-.708-.708L7.293 8 4.146 4.854a.5.5 0 0 1 0-.708z"/><path d="M11.146 4.146a.5.5 0 0 1 .708.708L8.707 8l3.147 3.146a.5.5 0 0 1-.708.708L8 8.707l-3.146 3.147a.5.5 0 0 1-.708-.708L7.293 8 4.146 4.854a.5.5 0 0 1 .708-.708L8 7.293l3.146-3.147a.5.5 0 0 1 .708-.708z"/></svg>';
                    }
                    else {
                        chatButton.innerHTML = 'Pengaduan';
                    }
                }
    
            }
        }

        if (chatButton && modal) {
            chatButton.addEventListener('click', toggleService);
        }
    });
</script>
@endpush
