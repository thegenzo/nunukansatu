@extends ('layouts.mall-informasi-layouts.dashboard')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card mb-3" style="height:100vh;">
              <div class="card-body">
                <iframe src="https://profil.nunukankab.go.id" id="appIframe" style=" top: 0; left: 0; width: 100%; height: 100%; border: 0;display: none;"></iframe>
                <div class="loading-screen" id="loading-message" style="display: block">
                  <div class="center">
                    <img src="{{ url ('/assets/Loading-Nunukansatu.gif')}}" alt="Nunukan Satu" class="logo-load" style="height: 100vh; width: auto;" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card mb-3">
          <div class="card-body">
            <div class="mc-1">
              <a href="https://elhkpn.kpk.go.id/portal/user/pengumuman_lhkpn/WjJweE5GTlhOa3BYUnpKakt6aHphelpHZDFkcVNEZGxXR2x3WTNkRFlrRTJPVTVHV0VGMWJqWXJORXAxZUZGQ1RVSjFVa2syUkVOdFVHUlBZMWg2Y2c9PQ==" class="mb-3" target="_blank">
                <button type="button" class="d-flex btn-login-siasn justify-content-center align-items-center" id="btnLoginAsn">
                  <img src="{{ url ('/assets/icons/lampiran_email_iframe.jpeg.jpg')}}" alt="logo kabupaten nunukan" />
                </button>
              </a>
              <a href="{{url ('/mall-informasi/transparansi')}}" id="anggaranLoad" class="mb-3" >
                <button type="button" class="d-flex btn-login-siasn justify-content-center align-items-center" id="btnLoginAsn">
                  <img src="{{ url ('/assets/icons/TransparansiAnggaran.jpg')}}" alt="logo kabupaten nunukan" />
                </button>
              </a>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- / Content -->
@endsection