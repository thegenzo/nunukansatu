@push('styles')
<style>
    .mall-data-informasi-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
    }
    .btn-group-mall-data-informasi {
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
    .button1-a {
        background-image: url('/assets/icons/mall-data.png');
        /* background-size: 200px; */
        background-position-y: center;
        background-position-x: center;
        height: 100%;
    }

    .button2-a {
        background-image: url('/assets/icons/mall-informasi.png');
        /* background-size: 200px; */
        background-position-y: center;
        background-position-x: center;
        height: 100%;
    }

    /* Change the background image on hover */
    .button1-a:hover {
        background-image: url('/assets/icons/mall-data-active.png');
    }
    .button2-a:hover {
        background-image: url('/assets/icons/mall-informasi-active.png');
    }
</style>
@endpush
<div class="modal fade" id="mallDataInformasiModal" tabindex="-1" aria-labelledby="mallLayananTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-layanan-main" style="overflow: hidden; height: 80vh;">
            <h2 class="text-center">MALL DATA DAN INFORMASI</h2>
            <div class=".modal-body-layanan">
                <div class="modal-body-layanan " role="group" aria-label="Button group">
                    <div class="btn-group-mall-layanan">
                        <button class="btn custom-button button1-a" id="btnMallData" ></button>
                        <div ></div>
                        <button class="btn custom-button button2-a" id="btnMallInformasi"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnMallData").click(function(){

            window.open("/mall-data/beranda", "_self")
            
        })
        $("#btnMallInformasi").click(function(){
            
            window.open("/mall-informasi/dashboard", "_self")
            
        })
    })
</script>
@endpush