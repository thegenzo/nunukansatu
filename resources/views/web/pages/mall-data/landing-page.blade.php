@extends('layouts.mall-data.layouts')
@section('title', 'Beranda')
@section('content')
<!-- HERO -->
<section id="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2>Selamat Datang di</h2>
        <h1 class="display-4">Mall <span>Data</span></h1>
        <p class="lead">Data Terbuka Pemerintah Kabupaten Nunukan</p>
      </div>
    </div>
  </div>
</section>
<!-- HERO -->

<!-- TABS -->
<section id="tabs">
  <div class="simulation-tab snipcss-lSsS7 style-tJzmC" id="style-tJzmC">
    <button data-bs-toggle="modal" data-bs-target="#exampleModal">
      Topik
    </button>
    <button class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
      OPD
    </button>
    <button class="active" id="btn-tab-urusan" onclick="changeTab('urusan')">
      Urusan Pemerintahan
    </button>
  </div>
</section>

<section id="datas" class="mb-5">
  <div class="container">
    <div id="tab-content-urusan" class="tab-content active">
      <!-- Isi konten untuk tab Dataset -->
      <div class="d-flex flex-lg-row flex-column w-100 justify-content-between mb-5">
        <div class="w-50">
          <h1 class="text-start">Urusan Pemerintahan</h1>
          <p class="text-start">
            Kumpulan data yang dapat diproses lebih lanjut. Mall Data
            Nunukan menyediakan akses ke banyak koleksi dataset dari semua
            instansi di Kabupaten Nunukan.
          </p>
        </div>
        <div class="d-flex align-items-end">
          <a href="{{ url ('/mall-data/urusan')}}" class="btn btn-cs-red">Selengkapnya</a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-datas">
                <div class="accordion" id="urusanShow"></div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card-datas">
                <iframe src="" height="540" width="100%" id="showDataset"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="tab-content-topik" class="tab-content">
      <!-- Isi konten untuk tab Sektoral -->
      <div class="d-flex flex-lg-row flex-column w-100 justify-content-between mb-5">
        <div class="w-50">
          <h1 class="text-start">Pemerintahan</h1>
          <p class="text-start">
            Kumpulan data yang dapat diproses lebih lanjut. Mall Data
            Nunukan menyediakan akses ke banyak koleksi dataset dari semua
            instansi di Kabupaten Nunukan.
          </p>
        </div>
        <div class="d-flex align-items-end">
          <a href="{{ url ('/mall-data/opd')}}" class="btn btn-cs-red">Selengkapnya</a>
        </div>
      </div>
    </div>
    <div id="tab-content-opd" class="tab-content">
      <!-- Isi konten untuk tab Sektoral -->
      <div class="d-flex flex-lg-row flex-column w-100 justify-content-between mb-5">
        <div class="w-50">
          <h1 class="text-start">OPD</h1>
          <p class="text-start">
            Kumpulan data yang dapat diproses lebih lanjut. Mall Data
            Nunukan menyediakan akses ke banyak koleksi dataset dari semua
            instansi di Kabupaten Nunukan.
          </p>
        </div>
        <div class="d-flex align-items-end">
          <a href="{{ url ('/mall-data/opd')}}" class="btn btn-cs-red">Selengkapnya</a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-datas">
                <div class="accordion" id="opdShow"></div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card-datas">
                <iframe src="" height="540" width="100%" id="showDataset2"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATISTIC -->
<section id="statistic" class="pb-5 pt-5">
  <div class="container">
    <div class="mb-5">
      <h1 class="text-center">Statistik</h1>
      <p class="text-center">
        Data yang tersedia di Mall Data Kabupaten Nunukan
      </p>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-4 col-md-12 mb-3">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">
              <div class="card disabled">
                <div class="img-const d-flex align-items-center">
                  <img src="/assets/logos/doc.png" class="text-center" alt="..." />
                </div>
                <div class="card-body">
                  <h5 class="card-title text-center">Topik</h5>
                  <h6 class="text-center">0</h6>
                  <p class="card-text text-center">
                    Jumlah Topik yang tersedia di Mall Data
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-12 mb-3">
            <a href="{{ url ('/mall-data/urusan')}}">
              <div class="card">
                <div class="img-const d-flex align-items-center">
                  <img src="/assets/logos/topic.png" class="text-center" alt="..." />
                </div>
                <div class="card-body">
                  <h5 class="card-title text-center">Urusan</h5>
                  <h6 class="text-center" id="urusan"></h6>
                  <p class="card-text text-center">
                    Jumlah Urusan yang tersedia di Mall Data
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-12 mb-3">
            <a href="{{ url ('/mall-data/opd')}}">
              <div class="card">
                <div class="img-const d-flex align-items-center">
                  <img src="/assets/logos/gov.png" class="text-center" alt="..." />
                </div>
                <div class="card-body">
                  <h5 class="card-title text-center">OPD</h5>
                  <h6 class="text-center" id="opd"></h6>
                  <p class="card-text text-center">
                    Jumlah OPD yang tersedia di Mall Data
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- STATISTIC -->
@endsection