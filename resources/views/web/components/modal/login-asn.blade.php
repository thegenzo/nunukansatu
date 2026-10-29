@push('styles')
<style>
    .login-asn-modal {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        min-height: 120%;

    }
    .logo-asn-modal {
        width: 350px;
    }
    .modal-login-asn {
        padding-top: 0px;
        background-image: url('/assets/bg-login.png');
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
    

    .btn-primary {
    background-image: url(../assets/icons/hide.png) no-repeat center;
    color: #fff;
    background-color: #c41218;
    border-color: #c41218;
    }

.btn-primary:hover {
    color: #c41218;
    background-color: #fff;
    border-color: #c41218;
}

.btn-primary:focus {
    color: #c41218;
    background-color: #fff;
    border-color: #c41218;
    background-size: contain;
    box-shadow: 0 0 0 0.25rem rgba(220,53,69,.5);
}



a {
  text-decoration: none;
}

.btn-login-siasn {
  display: flex;
  width: 248px !important;
  padding: 10px 16px;
  justify-content: center;
  align-items: center;
  gap: 8px;

  border-radius: 12px;
  background-color: #fff;

  border: 1px solid #e42127;
}

.btn-login-mail {
  display: flex;
  width: 284px !important;
  padding: 10px 16px;
  justify-content: center;
  align-items: center;
  gap: 8px;

  border-radius: 12px;
  background-color: #fff;

  border: 1px solid #e42127;
}
.btn-login-mail:hover {
  color: #fff;
  background-color: #e42127;
  border: 1px solid #ffffff;
  box-shadow: 3px 6px 10.8px 0px rgba(0, 0, 0, 0.25);
}
.btn-login-siasn:hover {
  color: #fff;
  background-color: #e42127;
  border: 1px solid #ffffff;
  box-shadow: 3px 6px 10.8px 0px rgba(0, 0, 0, 0.25);
}

.btn-login-mail img {
  width: 24px;
  height: 24px;
  left: 0;
}

.btn-login-siasn img {
  width: 24px;
  height: 24px;
  left: 0;
}

.lt-2 {
  display: flex;
  justify-content: flex-start;
}

/* Base styles */
.or::before,
.or::after {
  content: "";
}

/* 
    Vertical 
    Requires a height to be set on this element or its parent.
*/
.or--y {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 100%;
}

/* 
    Absolutely position each pseudo element, and calculate
    a height shorter than 50% using em units to create space
    around the text and allows divider line height to scale 
    based on parent element divider height.
*/
.or--y::before,
.or--y::after {
  position: absolute;
  border-left: 1px solid #ccc;
  height: calc(50% - 0.85em);
  left: 50%;
  margin-left: -1px;
}

/* ::before on top */
.or--y::before {
  top: 0;
}

/* ::after on bottom */
.or--y::after {
  bottom: 0;
}

/* Horizontal */
.or--x::before,
.or--x::after {
  position: relative;
  border-top: 1px solid #000000;
  display: inline-block;
  vertical-align: middle;
  width: 50%;
  margin-bottom: 0.15em;
  overflow: hidden;
}

.or--x::before {
  right: 1em;
  margin-left: -50%;
}

.or--x::after {
  left: 1em;
  margin-right: -50%;
}

/* Demo styles */
.demo {
  margin: 4em 1em;
  text-align: center;
}

.or {
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: #000000;
  font-size: 0.75em;
  margin: 0.5em auto;
}

.or--x {
  max-width: 30em;
}

.or--y {
  height: 4em;
}


.lt-2 {
  display: flex;
  justify-content: flex-start;
}


    #togglePassword {
      background-image: url(../assets/icons/hide.png) no-repeat center;
      background-size: contain;
      z-index: 100;
    }
    
    @media only screen and (max-width: 500px) {
        .modal-login-asn {
          background-image: url('/assets/bg-modal-login.png');
        }
        
        img#logo{
            display: none;
        }
        .login-container {
            margin-bottom:20px;
        }

    }
</style>
@endpush
<div class="modal fade" id="loginAsnModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-asn">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo-container" style="margin-bottom: 70px">
                            <img src="/assets/icons/logo-red-1.png" alt="Nunukan Satu" class="mx-auto logo-asn-modal mt-5" id="logo">
                        </div>
                        <div class="login-container">
                            <div class="or or--x" aria-role="presentation">Login SSO</div>
                            <a href="https://nunukankab.go.id/sso/login" class="mb-3">
                                <button type="button" class="d-flex btn-login-siasn justify-content-center align-items-center" style="width: 150px" id="btnLoginAsnExplicit">
                                    <div class="lt-2">
                                        <img src="/assets/MyASN.png" alt="SSO MyASN" style="width: 20px">
                                    </div>
                                    Masuk dengan MyASN
                                </button>
                            </a>
                            <div class="or or--x" aria-role="presentation">Mail Dinas</div>
                            <a href="https://mail.nunukankab.go.id/webmail/" class="mb-3" target="_blank">
                                <button type="button" class="d-flex btn-login-mail justify-content-center align-items-center" style="width: 180px">
                                    <div class="lt-2">
                                        <img src="/assets/icons/mail.png" alt="SSO MyASN" style="width: 20px">
                                    </div>
                                    Mail dinas @nunukankab.go.id
                                </button>
                            </a>
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
        $("#btnLoginAsn").click(function(){
            let _data = { nip: $("#nip").val(), password: $("#passwordAsn").val()};
            $("#btnLoginAsn").attr('disabled', 'true');
            $("#btnSpinner").removeClass('d-none');
            $.ajax({
                type: 'POST',
                url: '{{ route('web.sso-siasn') }}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                'dataType': 'json',
                'data': _data,
                success: function(data){
                    lStorage.set('userToken', data.access_token)
                    lStorage.set('userData', parseJwt(data.access_token));
                    lStorage.set('jabatan', data.jabatan);
                    lStorage.set('userType', 'ASN');
                    $("#loginAsnModal").modal('hide');  
                    $("#appAdminModal").modal('show');
                    $("#btnLoginAsn").removeAttr('disabled');
                    $("#btnSpinner").addClass('d-none');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "NIP atau Kata sandi anda salah!"
                    });
                    $("#btnLoginAsn").removeAttr('disabled');
                    $("#btnSpinner").addClass('d-none');
                }
            });
        })
    })
</script>
<!--
<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('passwordAsn');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
</script>
<script>
document.getElementById('openMailButton').addEventListener('click', function() {
    // Ganti window.location.href dengan window.open untuk membuka di tab baru
    window.open('https://mail.nunukankab.go.id', '_blank');
});
</script>
-->


@endpush