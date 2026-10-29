<div id="chatModal" class="custom-modal-pos" style=" display:none;">
  <div class=" modal-content-customs" >
    <button id="open-chatwoot" class="btn btn-cs mb-2">Hubungi Kami</button>
    <a id="bukuTamu" class="btn btn-cs mb-2" >Kunjungan</a>
    <button  class="btn btn-cs" data-bs-toggle="modal" data-bs-target="#modalSurveyFull">Survey</button>        
  </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatBtn = document.querySelector('#chatBtn');
        const modal = document.querySelector('#chatModal');
        const chatwootButton = document.querySelector('#open-chatwoot') || document.querySelector('.button.transparent.compact.close-button');
        const closeChatwootButton = document.querySelector('#close-chatwoot');
        const bukuTamuButton = document.querySelector('#bukuTamu');

        function isMobileDevice() {
            return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        }

            if (bukuTamuButton) {
                if (isMobileDevice()) {
                    bukuTamuButton.style.display = 'block'; // Show the button on mobile devices
                } else {
                    bukuTamuButton.style.display = 'none'; // Hide the button on non-mobile devices
                }
            }

        if (bukuTamuButton) {
            bukuTamuButton.addEventListener('click', function() {
                let token = localStorage.getItem('userToken');
                if (token) {
                    token = token.replace(/"/g, '');
                }
                
                const url = `https://ekinerja.nunukankab.go.id/ebukutamu/sso.php?access_token=${token}`;
                window.open(url, '_blank');
            });
        }

    function toggleModal() {
        if (modal) {
            modal.style.display = modal.style.display === "none" || modal.style.display === "" ? "block" : "none";
            if (chatBtn) {
                
                if (modal.style.display === "block") {
                    chatBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.854 4.146a.5.5 0 0 1 0 .708L8.707 8l-3.853 3.854a.5.5 0 0 1-.708-.708L7.293 8 4.146 4.854a.5.5 0 0 1 0-.708z"/><path d="M11.146 4.146a.5.5 0 0 1 .708.708L8.707 8l3.147 3.146a.5.5 0 0 1-.708.708L8 8.707l-3.146 3.147a.5.5 0 0 1-.708-.708L7.293 8 4.146 4.854a.5.5 0 0 1 .708-.708L8 7.293l3.146-3.147a.5.5 0 0 1 .708-.708z"/></svg>';
                }
                else {
                    chatBtn.innerHTML = 'Hubungi Kami';
                }
            }

        }
    }
        function toggleChatwoot() {
            window.$chatwoot.toggle();
            const isMobile = window.innerWidth < 768;

            if (closeChatwootButton) {
                closeChatwootButton.style.display = isMobile ? 'none' : 'block';
                chatBtn.innerHTML = '<svg width="800px" height="800px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:1.91px;}</style></defs><rect class="cls-1" x="6.27" y="5.32" width="11.45" height="15.27" rx="5.73"/><path class="cls-1" d="M17.73,9.14h1.91A2.86,2.86,0,0,1,22.5,12v1.91a2.86,2.86,0,0,1-2.86,2.86H17.73a0,0,0,0,1,0,0V9.14A0,0,0,0,1,17.73,9.14Z"/><path class="cls-1" d="M1.5,9.14H3.41A2.86,2.86,0,0,1,6.27,12v1.91a2.86,2.86,0,0,1-2.86,2.86H1.5a0,0,0,0,1,0,0V9.14A0,0,0,0,1,1.5,9.14Z" transform="translate(7.77 25.91) rotate(180)"/><path class="cls-1" d="M4.36,9.14h0A7.64,7.64,0,0,1,12,1.5h0a7.64,7.64,0,0,1,7.64,7.64h0"/><path class="cls-1" d="M19.64,16.77v1a4.78,4.78,0,0,1-4.78,4.77"/></svg>';
            }
            if (chatBtn) chatBtn.style.display = isMobile ? 'block' : 'none';
            if (modal) modal.style.display = "none";
        }

        function closeChatwoot() {
            window.$chatwoot.toggle('close');
            if (closeChatwootButton) closeChatwootButton.style.display = 'none';
            if (chatBtn) chatBtn.style.display = 'block';
        }

        if (chatBtn && modal) {
            chatBtn.addEventListener('click', toggleModal);
        }

        if (chatwootButton) {
            chatwootButton.addEventListener('click', toggleChatwoot);
        } else {
            console.error('chatwootButton not found');
        }

        if (closeChatwootButton) {
            closeChatwootButton.addEventListener('click', closeChatwoot);
        } else {
            console.error('closeChatwootButton not found');
        }
    });
</script>
@endpush
