<!DOCTYPE html>
<html>
<head>
    @include('includes.new_main.head')
</head>
<body>
        @include('new_main.includes.topbar')
        

        @yield('content')
    
        @include('new_main.includes.footer')

        <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>

        <style>
            a {
                color: #ee3124;
            }
        </style>

    @include('includes.new_main.script')
</body>
</html>