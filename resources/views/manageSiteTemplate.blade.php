<!DOCTYPE html>
<html>
<head>
    @include('includes.admin.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('includes.admin.navbar')
        @include('includes.admin.aside')

            @yield('content')

        @include('includes.admin.footer')
    </div>
    @include('includes.admin.script')
</body>
</html>