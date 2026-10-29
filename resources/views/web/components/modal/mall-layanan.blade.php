@push('styles')
<style>
    .mall-layanan-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
    }

    .modal-body-layanan{
        margin: auto;
        padding: 20px;
        width: 80%;
    }
    .btn-group-mall-layanan {
        display: flex;
        justify-content: space-between;
    }


    /* Base styles for the buttons */
    .custom-button {
        width: 100px; /* Set the width of your buttons */
        height: 280px; /* Set the height of your buttons */
        background-size: cover;
        background-repeat: no-repeat;
        border: none;
        cursor: pointer;
    }

    /* Set the background images for each button */
    .button1 {
        background-image: url('/assets/icons/layanan-administrasi.png');
        /* background-size: 200px; */
        /* height: 200px;
        width: auto; */
        background-position-y: center;
        background-position-x: center;
        height: 100%;
    }

    .button2 {
        background-image: url('/assets/icons/layanan-publik.png');
        /* background-size:; */
        background-position-y: center;
        background-position-x: center;
        height: 100%;
    }

    /* Change the background image on hover */
    .button1:hover {
        background-image: url('/assets/icons/layanan-administrasi-active.png');
    }
    .button2:hover {
        background-image: url('/assets/icons/layanan-publik-active.png');
    }
    
    @media only screen and (max-width:500px){
    .mall-layanan-modal {
        padding-top: 0px;
    }
    


        .button1 {
            height: 120px;
        }
    }
</style>
@endpush
<div class="modal fade" id="mallLayananModal" tabindex="-1" aria-labelledby="mallLayananTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-layanan-main" style="height: 80vh; overflow: hidden;">
            <h2 class="text-center">MALL LAYANAN</h2>
            <div class=".modal-body-layanan">
                <div class="modal-body-layanan " role="group" aria-label="Button group">
                    <div class="btn-group-mall-layanan">
                        <button class="btn custom-button button1" id="btnLayananAdmin" ></button>
                        <div ></div>
                        <button class="btn custom-button button2" id="btnLayananPublik"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnLayananAdmin").click(function(){
            if(lStorage.hasData('userType') && lStorage.get('userType') == "PUB"){
                // Jika ada session public, destroy
                lStorage.remove('userToken');
                lStorage.remove('userData');
                lStorage.remove('jabatan');
                lStorage.remove('userType');
            }
            $("#mallLayananModal").modal('hide');
            if(lStorage.hasData('userToken') == false){ // User belum login, show login modal
                $("#loginAsnModal").modal('show');   
            }
            else { // User sudah login, show app modal
                $("#appAdminModal").modal('show');
            }
        })
        $("#btnLayananPublik").click(function(){
            $("#mallLayananModal").modal('hide');
            $("#appPublikModal").modal('show');
        })
    })
</script>
@endpush