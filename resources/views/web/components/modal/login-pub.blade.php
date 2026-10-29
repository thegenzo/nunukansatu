@push('styles')
<style>
    .login-pub-modal {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        min-height: 100%;
    }
    .logo-pub-modal {
        width: 350px;
 
    }
    .modal-login-pub {

        padding-top: 0px;
        padding-bottom: 8px;
        background-image: url('/assets/bg-login-pub.png');
        background-position-y: center;
        background-position-x: center;
    }
    .logo-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    
        
    @media only screen and (max-width: 500px) {
            .modal-login-pub {
            background-image: url('/assets/bg-modal-login.png');
            height: 60vh;
        }
        
        img#logo{
            display: none;
           
        }
        .login-container {
            margin-top: 140px;
        }
    }
</style>
@endpush
<div class="modal fade" id="loginPubModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-pub">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo-container" style="margin-bottom: 70px">
                            <img src="/assets/icons/logo-red-1.png" alt="Nunukan Satu" class="mx-auto logo-pub-modal mt-5" id="logo">
                        </div>
                        <div class="login-container">
                            <div class="mb-3" style="width: 320px">
                                <input type="text" class="form-control" id="nik" placeholder="NIK">
                            </div>
                            <div class="mb-3 input-group" style="width: 320px">
                                <input type="password" class="form-control" id="passwordPub" placeholder="PASSWORD">
                                <button type="button" class="btn btn-primary" id="togglePasswordpub">Show</button>
                            </div>
                            <button type="button" class="btn btn-danger mt-3" style="width: 150px" id="btnLoginPub"><span class="spinner-border spinner-border-sm d-none" id="btnSpinnerPub" role="status" aria-hidden="true"></span>
                            MASUK</button>
                            <span class="pt-2">Belum memiliki akun?</span>   
                            <button type="button" class="btn btn-danger mt-3" style="width: 150px" id="btnDaftarPub"><span class="spinner-border spinner-border-sm d-none" id="btnSpinnerDaftarPub" role="status" aria-hidden="true"></span> DAFTAR</button>
                        </div>
                    </div>

                    <!-- Second Section -->
                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnLoginPub").click(function(){
            let _data = { nik: $("#nik").val(), password: $("#passwordPub").val()};
            $("#btnLoginPub").attr('disabled', 'true');
            $("#btnSpinnerPub").removeClass('d-none');
            $.ajax({
                type: 'POST',
                url: '{{ route('web.sso-pub') }}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                'dataType': 'json',
                'data': _data,
                success: function(data){
                    lStorage.set('userToken', data.access_token)
                    lStorage.set('userData', data.userData);
                    lStorage.set('userType', 'PUB');
                    $("#loginPubModal").modal('hide');  
                    $("#appPublikModal").modal('show');
                    $("#btnLoginPub").removeAttr('disabled');
                    $("#btnSpinnerPub").addClass('d-none');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "NIK atau Kata sandi anda salah!"
                    });
                    $("#btnLoginPub").removeAttr('disabled');
                    $("#btnSpinnerPub").addClass('d-none');
                }
            });
        })
        $("#btnDaftarPub").click(function(){
            let _data = { nik: $("#nik").val(), password: $("#passwordPub").val()};
            $("#btnDaftarPub").attr('disabled', 'true');
            $("#btnSpinnerDaftarPub").removeClass('d-none');
            $.ajax({
                type: 'POST',
                url: '{{ route('web.daftar-pub') }}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                'dataType': 'json',
                'data': _data,
                success: function(data){
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Pendaftaran telah diterima, anda akan menerima notifikasi via WhatsApp pada nomor " + data.masked_phone + " yang terdaftar di SIPAKRT"
                    });
                    $("#btnDaftarPub").removeAttr('disabled');
                    $("#btnSpinnerDaftarPub").addClass('d-none');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Pendaftaran gagal, harap periksa NIK anda dan perbarui nomor WhatsApp anda di SIPAKRT"
                    });
                    $("#btnDaftarPub").removeAttr('disabled');
                    $("#btnSpinnerDaftarPub").addClass('d-none');
                }
            });
        })
    })
</script>
<script>
  document.getElementById('togglePasswordpub').addEventListener('click', function () {
    const passwordInput = document.getElementById('passwordPub');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
</script>
@endpush