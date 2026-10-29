@extends ('layouts.mall-data.layouts')
@section('content')
        <style>
        /* Add your custom styles here */
        .card-body#not-found {
            font-family: 'Arial', sans-serif;
            background: radial-gradient(#e42127, #971f26), black;
            background-position-x: center;
            background-position-y: top;
            color: #fff;
            text-align: center;
            padding: 50px;
            height: 80vh;
            overflow: hidden;
        }

        h1 {
            font-size: 60px;
            margin-bottom: 20px;
            color: #fff;
        }

        .logo-app-404 {
            width: auto;
            height: 284px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        a {
            color: #3490dc;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-fluid flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="card mb-3" >
                        <div class="card-body" id="not-found">
                            <div class="text-center">
                                <img src="{{ url ('/assets/favnunukan.png')}}" class="logo-app-404"/>
                            </div>
                            <h1>Halaman Tidak Ditemukan</h1>
                            <p>Halaman yang Anda cari mungkin telah dihapus atau tidak lagi tersedia.</p>
                            <a href="{{ url('/mall-data/beranda') }}" class="btn btn-light">kembali ke home</a>   
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
@endsection