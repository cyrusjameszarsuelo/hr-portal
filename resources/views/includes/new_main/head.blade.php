    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> MEGANET | @yield('title')</title>
    <link rel="icon" href="{{ URL::asset('img/megawide-icon.png') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- animate.css-->
    <link href="{{ asset('assets/vendor/animate.css-master/animate.min.css') }}" rel="stylesheet">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <!-- Font Awesome 5 -->
    <link href="{{ asset('assets/vendor/fontawesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <!-- Fables Icons -->
    <link href="{{ asset('assets/custom/css/fables-icons.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap-4-navbar.css') }}" rel="stylesheet">
    <!-- portfolio filter gallery -->
    <link href="{{ asset('assets/vendor/portfolio-filter-gallery/portfolio-filter-gallery.css') }}" rel="stylesheet">
    <!-- FANCY BOX -->
    <link href="{{ asset('assets/vendor/fancybox-master/jquery.fancybox.min.css') }}" rel="stylesheet">
    <!-- RANGE SLIDER -->
    <link href="{{ asset('assets/vendor/range-slider/range-slider.css') }}" rel="stylesheet">
    <!-- OWL CAROUSEL  -->
    <link href="{{ asset('assets/vendor/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
    <!-- FABLES CUSTOM CSS FILE -->
    <link href="{{ asset('assets/custom/css/custom.css') }}" rel="stylesheet">
    <!-- FABLES CUSTOM CSS RESPONSIVE FILE -->
    <link href="{{ asset('assets/custom/css/custom-responsive.css') }}" rel="stylesheet">
    <!-- Timeline -->
    <link href="{{ URL::asset('assets/vendor/timeline/timeline.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/timeline/timelify.css') }}">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    </link>
    <!-- Hotjar Tracking Code for Human Resource Website -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 5360960,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
