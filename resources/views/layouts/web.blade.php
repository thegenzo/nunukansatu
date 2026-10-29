<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('assets/favnunukan.png') }}" rel="icon" type="image/png">
<title>@yield('title') - {{ config('app.name') }}</title>
<meta name="keywords" content="nunukan, Kabupaten Nunukan, Nunukan Satu, Simanja, TNDD, Ekinerja">
<meta name="author" content="Pemerintah Kabupaten Nunukan">
<meta name="description" content="Kabupaten Nunukan merupakan wilayah pemekaran dari Kabupaten Bulungan, yang terbentuk berdasarkan pertimbangan luas wilyah, peningkatan pembangunan, dan peningkatan pelayanan kepada masyarakat. Pemekaran Kabupaten bulungan ini di pelopori oleh Kolonel R.A. Besing yang pada saat itu menjabat sebagai Bupati Bulungan.">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@nunukankab" />
<meta name="twitter:creator" content="@nunukankab" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="language" content="Bahasa">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossOrigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="{{ url ('/css/style.css')}}" />
<link rel="stylesheet" href="{{ url ('/css/_accordion.scss')}}" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@stack('styles')
</head>

<body>
<!-- Main Body Area Start Here -->
<main>
    @yield('content')
</main>
<div class="button-group-cs">
    <button class="button-buble mobile-none text-white" id="chat-button" fdprocessedid="4mc8cbj" style="display:block" >
        Pengaduan
    </button>
    <button class="button-buble mobile-none text-white" id="chatBtn" fdprocessedid="4mc8cbj" style="display:block" >
        Hubungi Kami
    </button>
    <button class="button-buble mobile-none" id="close-chatwoot" fdprocessedid="4mc8cbj" style="display:none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.854 4.146a.5.5 0 0 1 0 .708L8.707 8l-3.853 3.854a.5.5 0 0 1-.708-.708L7.293 8 4.146 4.854a.5.5 0 0 1 0-.708z"/><path d="M11.146 4.146a.5.5 0 0 1 .708.708L8.707 8l3.147 3.146a.5.5 0 0 1-.708.708L8 8.707l-3.146 3.147a.5.5 0 0 1-.708-.708L7.293 8 4.146 4.854a.5.5 0 0 1 .708-.708L8 7.293l3.146-3.147a.5.5 0 0 1 .708-.708z"/></svg>
    </button>
</div>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossOrigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/localStorage.js"></script>
<script src="/js/jwt.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@stack('scripts')
<script type="text/javascript">
    @if(Session::has('success'))
    Swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "{{Session::get('success')}}"
    });
    @endif
    @if(Session::has('error'))
    Swal.fire({
        icon: "error",
        title: "Berhasil",
        text: "{{Session::get('error')}}"
    });
    @endif
    
    @if(Session::has('sso_data'))
    $(document).ready(function(){
        let data = {!! Session::get('sso_data') !!}
        lStorage.set('userToken', data.access_token)
        lStorage.set('userData', parseJwt(data.access_token));
        lStorage.set('jabatan', data.jabatan);
        lStorage.set('userType', 'ASN');
        lStorage.set('loginMode', 'keycloak_explicit');
        $("#appAdminModal").modal('show');
    });
    @endif
    $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.get('utm_from') == "keycloak-slo"){
            $("#loginAsnModal").modal('show');
            history.replaceState(null, null, "https://nunukankab.go.id")
        }
    });
</script>
<script>
    window.chatwootSettings = {"position":"right","type":"expanded_bubble","launcherTitle":"Hubungi kami"};
    (function(d,t) {
    var BASE_URL="https://crm.qloudkita.id";
    var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=BASE_URL+"/packs/js/sdk.js";
    g.defer = true;
    g.async = true;
    s.parentNode.insertBefore(g,s);
    g.onload=function(){
        window.chatwootSDK.run({
        websiteToken: '9S4TKEHM6HpcXwwD83kd2RBA',
        baseUrl: BASE_URL
        })
    }
    })(document,"script");
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var iframe = document.getElementById('appIframe');
        var loadingMessage = document.getElementById('loading-message');

        if (!iframe || !loadingMessage) {
            console.error('One or more elements could not be found');
            return;
        }

        $('[x-app-target]').on('click', function() {
            var iframe = document.getElementById('appIframe');
            var loadingMessage = document.getElementById('loading-message');
        
            if (!iframe || !loadingMessage) {
                console.error('One or more elements could not be found');
                return;
            }
        
            loadingMessage.style.display = 'block';
            iframe.style.display = 'none';
        
            iframe.onload = function() {
                console.log('iframe loaded');
                loadingMessage.style.display = 'none';
                iframe.style.display = 'block';
            };
        
            // Trigger the loading of the iframe
            iframe.src = iframe.src;
        });
    });
</script>
<script>
    function handleLinkClick(event) {
    var target = event.target;
    if (target.tagName.toLowerCase() === 'a') {
        event.preventDefault();
        var url = target.getAttribute('href');
        window.top.location.href = url;
    }
    }
    
    window.addEventListener('DOMContentLoaded', function() {
    var iframe = document.getElementById('appIframe');
    if (iframe) {
        iframe.contentWindow.document.addEventListener('click', handleLinkClick);
    }
    });
</script> 
<script>
    var swiper = new Swiper('.swiper-container', {
        allowTouchMove: false,
    });
    $('a[x-app-target="https://tndd.nunukankab.go.id/login/auth_sso"]').on('click', function(){
        $('button#chatBtn').addClass('hide-important');
    });
    $('a[x-app-target="https://ekinerja.nunukankab.go.id/login/sso.php"]').on('click', function(){
        $('button#chatBtn').addClass('hide-important');
    });
    $('#survey').on('click', function(){
        $('button#chatBtn').addClass('hide-important');
        $('button#chatBtn').addClass('hide-important');
    });
    $('button[aria-label="Close"]').on('click', function(){
        $('button.woot-widget-bubble').removeClass('hide-important');
        $('button#chatBtn').removeClass('hide-important');
    });
    $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.get('survey') == "true"){
            $('#classAdd').removeClass('modal-dialog-scrollable');
            $('#classAdd').addClass('modal-fullscreen');

            $('button.woot-widget-bubble').addClass('hide-important');
            $('#survey').click();
        }
    });
    $('button[type="submit"]').on('click', function(){
        $('.modal-body').scrollTop(0);
        $('.usia2').val($('#usia_get').val());
        $('.jenis_kelamin2').val($('#jenis_kelamin').val());
        $('.pendidikan2').val($('#pendidikan').val());
        $('.pekerjaan2').val($('#pekerjaan').val());
    });    
</script>
</body>
</html>