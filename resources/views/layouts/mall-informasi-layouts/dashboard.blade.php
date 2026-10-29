<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Mall Data dan Informasi - NUNUKANSATU</title>

  <!-- Favicon -->
  <link rel='icon' href="{{ url ('/assets/favnunukan.png')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic" rel="stylesheet">

  <!-- Include DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ url ('/vendor/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ url ('/vendor/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ url ('/vendor/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ url ('/vendor/assets/css/demo.css')}}" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ url ('/css/mall-layanan-app.css')}}" />



  @stack('styles')
</head>

<body>
  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body text-black">Fitur masih dalam tahap pengembangan</div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Tutup
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme overflow-scroll">
        <div class="app-brand demo">
          <a href="{{ url ('/')}}" class="app-brand-link">
            <img src="{{ url ('/assets/NNK-1.png')}}" class="logo-app" />
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item {{ Request::is('mall-informasi/dashboard') ? 'active' : '' }}">
            <a href="{{ url ('/mall-informasi/dashboard')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-detail"></i>
              <div data-i18n="Analytics">Web Daerah & OPD</div>
            </a>
          </li>

          <li class="menu-item ">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-bell"></i>
              <div data-i18n="Analytics">Pengumunan</div>
            </a>
          </li>

          <!-- New -->

          <li class="menu-item ">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="menu-link">
              <!-- <i class="menu-icon tf-icons bx bxs-bell"></i> -->
              <i class="menu-icon tf-icons bx bxs-data"></i>
              <div data-i18n="Analytics">JDIH</div>
            </a>
          </li>

          <!-- End New -->

          <!-- Layouts -->
          <li class="menu-item {{ Request::is('mall-informasi/berita') ? 'active' : '' }}">
            <a href="{{url ('/mall-informasi/berita')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-news"></i>
              <div data-i18n="Analytics">Berita</div>
            </a>
          </li>
          <!-- New -->

          <li class="menu-item ">
            <a href="{{url ('/mall-informasi/strategis')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-cabinet"></i>
              <div data-i18n="Analytics">Proyek Strategis Daerah</div>
            </a>
          </li>

          <li class="menu-item ">
            <a href="{{url ('/mall-informasi/transparansi')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-file-find"></i>
              <div data-i18n="Analytics">Transparansi Anggaran</div>
            </a>
                       
          </li>

          <!--<li class="menu-item ">
              <a href="{{url ('/mall-informasi/strategis')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cabinet"></i>
                <div data-i18n="Analytics">Proyek Strategis Daerah</div>
              </a>
            </li>

            <li class="menu-item " id="strategis-item">
              <a href="{{url ('/mall-informasi/strategis-daerah')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cabinet"></i>
                <div data-i18n="Analytics">Data Proyek Strategis Daerah</div>
              </a>
            </li>

            <li class="menu-item ">
              <a href="https://transparansi.nunukankab.go.id/" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-file-find"></i>
                <div data-i18n="Analytics">Transparansi Anggaran</div>
              </a>
            </li>

            <li class="menu-item " id="transparency-item">
              <a href="https://transparansi.nunukankab.go.id/" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-bell"></i>
                <i class="menu-icon tf-icons bx bxs-file-find"></i>
                <div data-i18n="Analytics">Data Transparansi</div> 
              </a>
            </li>-->

          <!--<li class="menu-item " id="transparency-item">
              <a href="{{route('web.mall-informasi.transparansi-index')}}" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-bell"></i>
                <i class="menu-icon tf-icons bx bxs-file-find"></i>
                <div data-i18n="Analytics">Data Transparansi</div> 
              </a>
            </li> -->

          <!-- End New -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-paperclip"></i>
              <div data-i18n="Layouts">Layanan Adminitrasi Pemerintahan</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <div data-i18n="Without menu">Layanan Naskah Dinas dan Kearsipan</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <div data-i18n="Without navbar">Layanan Manajemen Kepegawaian</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <div data-i18n="Container">Layanan Manajemen Perencanaan dan Anggaran</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <div data-i18n="Fluid">Layanan Manajemen Keuangan</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <div data-i18n="Blank">Layanan Manajemen Kinerja Pegawai</div>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-buildings"></i>
              <div data-i18n="Account Settings">Informasi Publik</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.complaint') }}" class="menu-link">
                  <div data-i18n="Account">Informasi Pengaduan</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.law') }}" class="menu-link">
                  <div data-i18n="Notifications">Informasi Hukum </div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.education') }}" class="menu-link">
                  <div data-i18n="Connections">Informasi Sektor Pendidikan</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.geospatial') }}" class="menu-link">
                  <div data-i18n="Connections">Informasi Geospasial</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.documentation') }}" class="menu-link">
                  <div data-i18n="Connections">Informasi Dokumentasi</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.residence') }}" class="menu-link">
                  <div data-i18n="Connections">Informasi Kependudukan</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.tax-retribution') }}" class="menu-link">
                  <div data-i18n="Connections">Informasi Pajak Retribusi</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('web.mall-informasi.public-info.business-retribution') }}" class="menu-link">
                  <div data-i18n="Connections">Informasi Berusaha</div>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </aside>

      <div class="layout-page">

        <nav
          class="layout-navbar container-fluid navbar navbar-expand-xl navbar-expand-bottom navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center justify-content-between" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <!-- @if(Request::is('mall-informasi/dashboard'))
                          <ul class="navbar-nav d-flex flex-row ">
                              <li class="nav-item mt-3">
                                  <h5>Profil</h5>
                              </li>
                          </ul>
                      @elseif(Request::is('mall-informasi/berita')) 
                          <ul class="navbar-nav d-flex flex-row ">
                              <li class="nav-item mt-3">
                                  <h5>Berita</h5>
                              </li>
                          </ul>
                       @elseif(Request::is('mall-informasi/transparansi*')) 
                          <ul class="navbar-nav d-flex flex-row ">
                              <li class="nav-item mt-3">
                                  <h5>Transparansi Anggaran</h5>
                              </li>
                          </ul>
                        @endif -->
                <ul class="navbar-nav d-flex flex-row ">
                  <li class="nav-item mt-3">
                    @if(Request::is('mall-informasi/transparansi*'))
                    <h5>Transparansi Anggaran</h5>
                    @else
                    <h5>@yield('page_title')</h5>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
            <a href="/" class="btn btn-primary-customs">Kembali</a>
          </div>
        </nav>
        <script>
          // Wait for the DOM to fully load before running the script
          document.addEventListener('DOMContentLoaded', function() {
            // Check if 'userData' exists in localStorage
            // console.log(JSON.parse(localStorage.getItem('userData')).nik);
            if (localStorage.getItem('userData') == null) {
              // If it exists, hide the 'li' element with id 'transparency-item'
              document.getElementById('transparency-item').style.display = 'none';
              document.getElementById('strategis-item').style.display = 'none';
            } else {
              document.getElementById('transparency-item').style.display = 'block';
              document.getElementById('strategis-item').style.display = 'block';
            }
          });

          document.addEventListener('DOMContentLoaded', function() {
            // Get the 'nik' value from localStorage
            var nikAdmins = JSON.parse(localStorage.getItem('userData'))?.nik;

            // Get all elements with the class 'actionYears'
            const actionYearsElements = document.querySelectorAll('.actionYears');

            // Loop through each element and adjust its display style
            actionYearsElements.forEach(function(element) {
              if (nikAdmins === '4949494949494949') {
                element.style.display = 'inline-block'; // Show the element (can be block or inline depending on the layout)
              } else {
                element.style.display = 'none'; // Hide the element
              }
            });
          });
        </script>

        <div class="content-wrapper">
          <div class="content-backdrop fade"></div>
        </div>
        @yield('content')


        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div>
  <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <script src="{{ url ('/vendor/assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ url ('/vendor/assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{ url ('/vendor/assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{ url ('/vendor/assets/vendor/js/helpers.js')}}"></script>

  <script src="{{ url ('/vendor/assets/vendor/js/menu.js')}}"></script>
  <script src="{{ url ('/vendor/assets/js/main.js')}}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Include DataTables JS -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // Initialize DataTable
      $('#myTable').DataTable();
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var iframe = document.getElementById('appIframe');
      var loadingMessage = document.getElementById('loading-message');

      if (!iframe || !loadingMessage) {
        console.error('One or more elements could not be found');
        return;
      }
      setTimeout(function() {
        console.log('iframe loaded');
        loadingMessage.style.display = 'none';
        iframe.style.display = 'block';
      }, 5000);
    });
  </script>

  @stack('addon-script')
</body>

</html>