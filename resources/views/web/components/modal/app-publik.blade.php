@push('styles')
<style>
    .app-publik-modal {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        min-height: 100%;
        overflow-y: auto;
    }
    .modal-app-publik {
        padding-top: 0px;
    }
    .logo-app-publik-modal {
        width: 250px;
    }
    .app-icon {
        width: 100px;
    }
    .app-list-pub {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .apps-column {
        margin-right: 20px;
    }
    
    .modal-dialog#admin{
        max-width:90vh;
    }
</style>
@endpush
<div class="modal fade" id="appPublikModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" id="admin">
    <div class="modal-content background-modal modal-app-publik">
      <div class="modal-body app-publik-modal text-center">

        <img src="https://admin-mall.nunukankab.go.id/images/1740019130.png" alt="Nunukan Satu" class="mx-auto logo-app-publik-modal">

        @if(Auth::check())
          <h3 class="mt-4">Selamat Datang, <span id="ssoNamePub"></span></h3>
          <button type="button" class="btn btn-danger my-3" style="width: 150px" id="btnLogoutPublik">KELUAR</button>
        @endif

        <p class="mt-2">Silahkan pilih layanan yang anda inginkan</p>

        <div class="accordion mt-4" id="accordionApps">
          
          <!-- LAYANAN PENGADUAN -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                LAYANAN PENGADUAN
              </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub" x-app-target="https://lapor.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/sp4nlapor.png" alt="SP4N LAPOR" class="img-fluid app-icon">
                </a>
                <a href="#" class="app-list-pub" x-app-target="https://satpolpp.nunukankab.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/silapdat.png" alt="SILAPDAT" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN HUKUM -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                LAYANAN HUKUM
              </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub" x-app-target="https://jdih.nunukankab.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/jdih.png" alt="JDIH" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN SEKTOR PENDIDIKAN -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                LAYANAN SEKTOR PENDIDIKAN
              </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub disabled" x-app-type="iframe">
                  <img src="/assets/icons/apps/dapodik.png" alt="DAPODIK" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN GEOSPASIAL -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                LAYANAN GEOSPASIAL
              </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub" x-app-target="https://gis.nunukankab.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/gis.png" alt="GIS" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN INFORMASI & DOKUMENTASI -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                LAYANAN INFORMASI DAN DOKUMENTASI
              </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub disabled" x-app-type="iframe">
                  <img src="/assets/icons/apps/ppid.png" alt="PPID" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN KEPENDUDUKAN -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading6">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">
                LAYANAN KEPENDUDUKAN
              </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub" x-app-target="https://sipakrt.nunukankab.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/sipakrt.png" alt="SIPAKRT" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN PAJAK RETRIBUSI -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading7">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7">
                LAYANAN PAJAK RETRIBUSI
              </button>
            </h2>
            <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub" x-app-target="https://pendapatan-nnk.id" x-app-type="direct">
                  <img src="/assets/icons/apps/bth.png" alt="BTH" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

          <!-- LAYANAN BERUSAHA -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading8">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8">
                LAYANAN BERUSAHA
              </button>
            </h2>
            <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#accordionApps">
              <div class="accordion-body d-flex flex-wrap gap-4 justify-content-center">
                <a href="#" class="app-list-pub" x-app-target="https://oss.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/oss.png" alt="OSS" class="img-fluid app-icon">
                </a>
                <a href="#" class="app-list-pub" x-app-target="https://sempadan.nunukankab.go.id" x-app-type="direct">
                  <img src="/assets/icons/apps/sempadan.png" alt="Sempadan" class="img-fluid app-icon">
                </a>
              </div>
            </div>
          </div>

        </div> <!-- end accordion -->
      </div>
    </div>
  </div>
</div>


@push('scripts')
<script type="text/javascript">
    $(document).on('show.bs.modal','#appPublikModal', function () {
        let userData = lStorage.get('userData');
        $("#ssoNamePub").html(userData.name);
    })
    $(document).ready(function() {
        $("#btnLogoutPublik").click(function(){
            lStorage.remove('userToken');
            lStorage.remove('userData');
            lStorage.remove('jabatan');
            lStorage.remove('userType');
            $("#appPublikModal").modal('hide')
            $("#loginPubModal").modal('show')
        })
        // Attach click event to all buttons with class "myButton"
        $(".app-list-pub").click(function() {
            var appTarget = $(this).attr('x-app-target');
            var appType = $(this).attr('x-app-type');

            if(appType == "iframe"){
                if(appTarget.length){
                    var appName = $(this).parent().parent().prev().children().html();
                    $("#fullPageModalLabel").html(appName);

                    let userToken = lStorage.get('userToken');
                    
                    $("#appIframe").attr("src", appTarget + "?access_token=" + userToken);
                    // You can add your custom jQuery code here
                    $("#fullPageModal").modal('show')
                }
            }
            if(appType == "direct"){
                window.open(appTarget, '_blank');
            }
        });
    });
</script>
@endpush