@push('styles')
<style>
    .app-admin-modal {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        min-height: 100%;
        overflow: scroll;
    }

    .modal-app-admin {
        padding-top: 0px;
    }
    
    .logo-app-admin-modal {
        width: 250px;
    }

    .app-icon {
        width: 100px;
    }

    .app-list {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .apps-column {
        margin-right: 20px;
    }

    @media only screen and (max-width: 500px) {


        .bg-modal-admin {
            padding: 32px;
        }

        .modal-customs {
            height: 100vh;
        }
        
    }
</style>
@endpush
<div class="modal fade" id="appAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content bg-modal-admin  background-modal modal-app-admin modal-custom">
            <div class="modal-body app-admin-modal" id="mt">
                <img src="{{url ('/assets/icons/logo-red-1.png')}}" alt="Nunukan Satu" class="mx-auto logo-app-admin-modal">
                <h3 class="mt-5">Selamat Datang, <span id="ssoName"></span></h3>
                <button type="button" class="btn btn-danger pb-2" style="width: 150px" id="btnLogoutAdmin">KELUAR</button>
                <span>Silahkan pilih layanan:</span>
                <br>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Layanan Naskah Dinas dan Kearsipan
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" >
                            <div class="accordion-body d-flex justify-content-center">
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://tndd.nunukankab.go.id/login/auth_sso" x-app-type="iframe" x-app-role="*">
                                    <img src="/assets/icons/apps/tndd.png" alt="TNDD"  class="img-fluid app-icon"> 
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://rapat.nunukankab.go.id/sso.php" x-app-type="iframe" x-app-role="kepala dinas;kepala bidang;kepala satuan;sekretaris;kepala bagian">
                                    <img src="/assets/icons/apps/sirapel.png" alt="Sirapel" class="img-fluid app-icon">
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://srikandi.arsip.go.id" x-app-type="direct" x-app-role="*">
                                    <img src="/assets/icons/apps/srknd.png" alt="Srikandi" class="img-fluid app-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Layanan Manajemen Kepegawaian
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body d-flex justify-content-center">
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://eanjab.nunukankab.go.id/sso.php" x-app-type="iframe" x-app-role="kepala dinas">
                                    <img src="/assets/icons/apps/eAnjab.png" alt="EANJAB" class="img-fluid app-icon">
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://siasn-instansi.bkn.go.id" x-app-type="direct" x-app-role="*">
                                    <img src="/assets/icons/apps/siasn.png" alt="SIASN" class="img-fluid app-icon">
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://nunukankab.simpegnas.go.id/simpegnas/personal/dashboard" x-app-type="direct" x-app-role="*">
                                    <img src="/assets/icons/apps/Simpegnas.png" alt="Simpegnas" class="img-fluid app-icon">
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://kinerja.bkn.go.id/profil" x-app-type="direct" x-app-role="*">
                                    <img src="/assets/icons/apps/kinerja_logo.png" alt="Kinerja" class="img-fluid app-icon">
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://myasn.bkn.go.id/" x-app-type="direct" x-app-role="*">
                                    <img src="/assets/icons/apps/myasn.png" alt="MyAsn" class="img-fluid app-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Layanan Manajemen Perencanaan dan Anggaran
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body d-flex justify-content-center">
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://sipecel.nunukankab.go.id/login/auth_sso" x-app-type="iframe" x-app-role="kepala dinas;kepala bidang;sekretaris">
                                    <img src="/assets/icons/apps/Sipecel.png" alt="SIPECEL" class="img-fluid app-icon">
                                </a>
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://sipd-ri.kemendagri.go.id" x-app-type="direct" x-app-role="kepala">
                                    <img src="/assets/icons/apps/SIPD.png" alt="SIPD" class="img-fluid app-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Layanan Manajemen Keuangan
                            </button>
                        </h2>
                        <div id="flush-collapsefour" class="accordion-collapse collapse" style="border-width:0px" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body d-flex justify-content-center">
                                <a href="#" class="list-group-item list-group-item-action app-list" aria-current="false" x-app-target="https://nunukankab.fmis.id/2023" x-app-type="iframe" x-app-role="bendahara">
                                    <img src="/assets/icons/apps/fmis.png" alt="FMIS" class="img-fluid app-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefive" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Layanan Manajemen Kinerja
                            </button>
                        </h2>
                        <div id="flush-collapsefive" class="accordion-collapse collapse" style="border-width:0px" aria-labelledby="flush-headingfive" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body d-flex justify-content-center">
                                <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://ekinerja.nunukankab.go.id/login/sso.php" x-app-type="iframe" x-app-role="*">
                                    <img src="/assets/icons/apps/simanja.png" alt="SIMANJA" class="img-fluid app-icon">
                                </a>
                                <a href="#" id="eprese" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://ekinerja.nunukankab.go.id/presence/sso.php" x-app-type="epresence" x-app-role="*">
                                    <img src="/assets/icons/apps/siputih.png" alt="SIMANJA" class="img-fluid app-icon">
                                </a>
                                 <a href="#" class="list-group-item list-group-item-action app-list" style="border-width:0px" aria-current="false" x-app-target="https://sepakat.nunukankab.go.id/auth/sso" x-app-type="iframe" x-app-role="*">
                                    <img src="/assets/icons/apps/sepakat.png" alt="SEPAKAT" class="img-fluid app-icon">
                                    <!--x-app-role="sekretaris;auditor;pengawas penyelenggaraan;pengawas pemerintahan madya;kepala bagian"-->
                                 </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).on('show.bs.modal', '#appAdminModal', function() {
        let userData = lStorage.get('userData');
        $("#ssoName").html(userData.name);
        let jabatan = lStorage.get('jabatan');
        let jabatanString = jabatan.toLowerCase();
        $(".app-list").each((i, e) => {
            let role = $(e).attr('x-app-role');
            if (role !== "*") {
                let roleMatched = false;
                // Jika bukan all, check jabatan string saat ini
                let splitList = role.split(";");
                for (let i = 0; i < splitList.length; i++) {
                    if (jabatanString.includes(splitList[i])) {
                        roleMatched = true;
                        break;
                    }
                }
                if (!roleMatched) {
                    $(e).addClass('d-none');
                } else {
                    $(e).removeClass('d-none');
                }
            }
        })
    })
    $(document).ready(function() {
        // Attach click event to all buttons with class "myButton"
        $("#btnLogoutAdmin").click(function() {
            lStorage.remove('userToken');
            lStorage.remove('userData');
            lStorage.remove('jabatan');
            lStorage.remove('userType');
            if(lStorage.hasData('loginMode') && lStorage.get('loginMode') == "keycloak_explicit"){
                lStorage.remove('loginMode');
                $(location).attr('href','{{route('web.sso-logout')}}')
            }
            else {
                $("#appAdminModal").modal('hide')
                $("#loginAsnModal").modal('show')
            }
        })
        $(".app-list").click(function() {
            var appTarget = $(this).attr('x-app-target');
            var appType = $(this).attr('x-app-type');

            if (appType == "iframe") {
                if (appTarget.length) {
                    var appName = $(this).parent().parent().prev().children().html();
                    $("#fullPageModalLabel").html(appName);

                    let userToken = lStorage.get('userToken');

                    $("#appIframe").attr("src", appTarget + "?access_token=" + userToken);
                    // You can add your custom jQuery code here
                    $("#fullPageModal").modal('show')
                }
            }
            if (appType == "direct") {
                window.open(appTarget, '_blank');
            }
            if (appType == "epresence") {
               
                let userToken = lStorage.get('userToken');
                window.open(appTarget + "?access_token=" + userToken, '_blank' );
            }
        });
    });
</script>
@endpush