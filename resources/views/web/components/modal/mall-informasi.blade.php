@push('styles')
<style>
    .mall-informasi-modal {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 50%;
        padding-top: 35px;
    }
    .btn-group-mall-informasi {
        width: 500px;
    }
    /* Base styles for the buttons */
    .custom-button {
        width: 100px; /* Set the width of your buttons */
        height: 275px; /* Set the height of your buttons */
        background-size: cover;
        background-repeat: no-repeat;
        border: none;
        cursor: pointer;
    }
    .modal-data-informasi-main {
        height: 70vh;
        width: 80vw;
    }

    /* Set the background images for each button */
    .button1-b {
        background-image: url('/assets/icons/profile.png');
        background-size: 200px;
        background-position-y: center;
        background-position-x: center;
    }

    .button2-b {
        background-image: url('/assets/icons/berita.png');
        background-size: 200px;
        background-position-y: center;
        background-position-x: center;
    }

    /* Change the background image on hover */
    .button1-b:hover {
        background-image: url('/assets/icons/profile-active.png');
    }
    .button2-b:hover {
        background-image: url('/assets/icons/berita-active.png');
    }


</style>
@endpush
<div class="modal fade" id="mallInformasiModal" tabindex="-1" aria-labelledby="mallLayananTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-data-informasi-main">
            <h2 class="text-center">MALL INFORMASI</h2>
            <div class="modal-body mall-informasi-modal">
                <div class="btn-group btn-group-mall-informasi" role="group" aria-label="Button group">
                    <button class="btn custom-button button1-b" id="btnProfile"></button>
                    <div style="width: 150px"></div>
                    <button class="btn custom-button button2-b" id="btnBerita"></button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnProfile").click(function(){
            $("#fullPageModalLabel").html("PROFILE");
            $("#appIframe").attr("src", "https://profil.nunukankab.go.id");
            // You can add your custom jQuery code here
            $("#fullPageModal").modal('show')
            
        })
        $("#btnBerita").click(function(){
            $("#fullPageModalLabel").html("BERITA");
            $("#appIframe").attr("src", "https://berita.nunukankab.go.id");
            // You can add your custom jQuery code here
            $("#fullPageModal").modal('show')
            
        })
        $("#btntransparansi-anggaran").click(function(){
            $("#fullPageModalLabel").html("TRANSPARASI-ANGGARAN");
            $("#appIframe").attr("src", "https://transparansi.nunukankab.go.id/");
            // You can add your custom jQuery code here
            $("#fullPageModal").modal('show')
            
        })
    })
</script>
@endpush