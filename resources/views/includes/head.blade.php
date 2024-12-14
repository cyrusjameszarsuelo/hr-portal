    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title> HR Portal | @yield('title')</title>
    <link rel="icon" href="{{ URL::asset('img/megawide-icon.png')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="{{ URL::asset ('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="{{ URL::asset ('assets/vendor/animate.css-master/animate.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset ('assets/vendor/loadscreen/css/spinkit.css')}}" rel="stylesheet">
    <!-- Bootstrap CSS --> 
    {{-- <link href="{{ URL::asset ('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset ('assets/vendor/bootstrap/css/bootstrap-4-navbar.css')}}" rel="stylesheet"> --}}

     <!-- portfolio filter gallery -->
    <link href="{{ URL::asset ('assets/vendor/portfolio-filter-gallery/portfolio-filter-gallery.css')}}" rel="stylesheet">
    <!-- FANCY BOX -->
    <link href="{{ URL::asset ('assets/vendor/fancybox-master/jquery.fancybox.min.css')}}" rel="stylesheet"> 
    <!-- RANGE SLIDER -->
    {{-- <link href="{{ URL::asset ('assets/vendor/range-slider/range-slider.css')}}" rel="stylesheet"> --}}
    <!-- Timeline -->
    <link href="{{ URL::asset ('assets/vendor/timeline/timeline.css')}}" rel="stylesheet"> 
    <link href="{{ URL::asset ('assets/vendor/timeline/timelify.css')}}">
    <!-- OWL CAROUSEL  --> 
    <link href="{{ URL::asset ('assets/vendor/owlcarousel/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset ('assets/vendor/owlcarousel/owl.theme.default.min.css')}}" rel="stylesheet">
    <!-- FABLES CUSTOM CSS FILE -->
    <link href="{{ URL::asset ('assets/custom/css/custom.css')}}" rel="stylesheet">
    <!-- FABLES CUSTOM CSS RESPONSIVE FILE -->
    <link href="{{ URL::asset ('assets/custom/css/custom-responsive.css')}}" rel="stylesheet">
    <!-- Fables Icons -->
    <link href="{{ URL::asset ('assets/custom/css/fables-icons.css')}}" rel="stylesheet"> 

    <!-- Video Background -->
    <link href="{{ URL::asset ('assets/vendor/video-background/video-background.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset ('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset ('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
   <script
src="https://www.gstatic.com/charts/loader.js">
</script>

 {{--    <link rel="stylesheet" href="{{ URL::asset ('treeMakerlib/tree_maker-min.css')}}">
    <script type="text/javascript" src="{{ URL::asset ('treeMakerlib/tree_maker-min.js')}}"></script>  --}}

    <link href="https://unpkg.com/treeflex/dist/css/treeflex.css" rel="stylesheet">

    {{-- <link href="{{ URL::asset ('extensions/DataInspector.css')}}"  rel="stylesheet" >
    <script src="{{ URL::asset ('release/go.js')}}"></script>
    <script src="{{ URL::asset ('extensions/DataInspector.js')}}"></script> --}}
