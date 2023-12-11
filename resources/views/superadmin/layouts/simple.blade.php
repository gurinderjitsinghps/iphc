<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IPHC') }} - @yield('title')</title>

    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- animate CSS-->
    <link href="/assets/css/animate.css" rel="stylesheet" type="text/css">
    <!-- Icons CSS-->
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css">
    <!-- Custom Style-->
    <link href="/assets/css/app-style.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <script src="/js/common.js"></script> --}}

    @stack('styles')
</head>
<body>
       
                @yield('content')

                <script src="/assets/js/jquery.min.js"></script>
                <script src="/assets/js/popper.min.js"></script>
                <script src="/assets/js/bootstrap.min.js"></script>
            @stack('scripts')
          
</body>
</html>
