<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
</head>
<body>

    @if(Request::segment(1) !== 'home' && Request::segment(1) !== 'company-events' && Request::segment(1) !== 'meganews'&& Request::segment(1) !== 'mega-good-vibes' )

        @include('includes.topbar')
        @include('includes.navbar')

    @endif

        @yield('content')
    
    @if(Request::segment(1) !== 'home' && Request::segment(1) !== 'company-events'  && Request::segment(1) !== 'meganews' && Request::segment(1) !== 'mega-good-vibes')

        @include('includes.footer')

        <!-- Back to Top -->
        <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>
    @endif

        @include('includes.script')
</body>
</html>