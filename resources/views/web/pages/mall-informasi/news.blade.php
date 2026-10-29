@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Berita')

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
                <iframe
                  src="https://berita.nunukankab.go.id/index.php?page=home"
                  id="appIframe"
                  style=" top: 0; left: 0; width: 100%; height: 100%; border: 0;display: none;"></iframe>
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
  </div>
</div>
<!-- / Content -->


@endsection