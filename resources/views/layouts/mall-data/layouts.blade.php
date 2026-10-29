<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Satu Data Kabupaten Nunukan</title>
    <link rel="icon" href="/assets/logos/fav.png" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.min.css"
    />
    <link rel="stylesheet" href="/css/mall-data-app.css" />
    <link
      href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- NAVBAR -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">Fitur masih dalam tahap pengembangan</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
    <nav id="myNavbar" class="navbar sticky-top navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="{{ url ('/mall-data/beranda')}}">
          <img
            id="logo"
            src="/assets/logos/Logo.png"
            alt="Mall Data"
            width="auto"
            height="80px"
            class="tilt"
            data-tilt
            data-tilt-scale="1.1"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('mall-data/beranda') ? 'active' : '' }}" aria-current="page" href="{{ url ('/mall-data/beranda')}}">
                Beranda
                </a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Topik
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a
                    class="dropdown-item"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    href="#"
                    >LAKIP</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    href="#"
                    >LPPD</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    href="#"
                    >LKJIP</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    href="#"
                    >SPM</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    href="#"
                    >STATISTIK SEKTORAL</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('mall-data/opd') ? 'active' : '' }}" href="{{ url ('/mall-data/opd')}}">OPD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('mall-data/urusan') ? 'active' : '' }}" href="{{ url ('/mall-data/urusan')}}">Urusan</a>
            </li>
            <li>
              <a href="/" class="btn btn-primary-customs" >Kembali</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- NAVBAR -->
    <!-- LOADING -->
    <div class="loading-screen" id="loading-message" style="display: block">
      <div class="center">
        <img
          src="/assets/logos/Loading-Nunukansatu.gif"
          alt="Nunukan Satu"
          class="logo-load"
          style="height: 100vh; width: auto"
        />
      </div>
    </div>
    <!-- LOADING -->
@yield('content')
    <!-- FOOTER -->
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div
              class="d-flex justify-content-between align-items-center flex-row"
            >
              <img
                src="/assets/logos/Logo.png"
                alt="Mall Data"
                width="auto"
                height="80px"
                class="mb-3 tilt"
                data-tilt
                data-tilt-scale="1.1"
              />
              <p class="ms-3">
                @2024 Mall Data. All Rights Reserved. <br />
                Made with ❤️ by
                <a href="https://nunukankab.go.id/">Nunukan Satu</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/js/mall-data-app.js"></script>
    @switch(Request::path())
        @case('mall-data/beranda')
            <script src="/js/apiHome.js"></script>
            @break
        @case('mall-data/opd')
            <script src="/js/apiPemerintahan.js"></script>
            @break
        @case('mall-data/urusan')
            <script src="/js/apiUrusan.js"></script>
            @break
        @default
            <script src="/js/detail.js"></script>
    @endswitch

  </body>
</html>
