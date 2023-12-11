<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vaye') }} - @yield('title')</title>

    <link rel="icon" href="/assets/images/logo.png" type="image/x-icon">
    <!-- Vector CSS -->
    <link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <!-- simplebar CSS-->
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <!-- Bootstrap core CSS-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--Switchery-->
    <link href="/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet">
    <link href="/assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <!-- animate CSS-->
    <link href="/assets/css/animate.css" rel="stylesheet" type="text/css">
    <!-- Icons CSS-->
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css">
    <!-- Sidebar CSS-->
    <link href="/assets/css/sidebar-menu.css" rel="stylesheet">
    <!-- Custom Style-->
    <link href="/assets/css/app-style.css" rel="stylesheet">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    @stack('styles')
</head>
<body  style="margin:0;">

    <div class="animate-bottom">
        <!-- Start wrapper-->
        <div id="wrapper">
                @include('superadmin.layouts.navigation')
                @include('superadmin.partials.header')
                @yield('content')
            </div>
            {{-- @include('verificator.partials.notifications') --}}
            </div>
             <!-- Bootstrap core JavaScript-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    {{-- <script src="/build/assets/app-c75e0372.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/assets/js/common.js"></script>
            @stack('scripts')

</body>
</html>
