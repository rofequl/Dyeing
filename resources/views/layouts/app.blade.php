<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <meta name="description"
          content="A premium collection of beautiful hand-crafted Bootstrap 4 admin dashboard templates and dozens of custom components built for data-driven applications.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.3.1"
          href="{{asset('assets/styles/shards-dashboards.1.3.1.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/extras.1.3.1.min.css')}}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @stack('style')
</head>
<body class="h-100">
<div class="container-fluid">
    <div class="row">
        @include('inc.sidebar')
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            @include('inc.header')
            @yield('content')
            @include('inc.footer')
        </main>
    </div>
</div>
<script src="{{asset('assets/scripts/jquery-3.3.1.min.js')}}"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/scripts/popper.min.js')}}"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="{{asset('assets/scripts/bootstrap.min.js')}}"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="{{asset('assets/scripts/shards.min.js')}}"></script>
<script src="{{asset('assets/scripts/jquery.sharrre.min.js')}}"></script>
<script src="{{asset('assets/scripts/extras.1.3.1.min.js')}}"></script>
<script src="{{asset('assets/scripts/shards-dashboards.1.3.1.min.js')}}"></script>
@stack('script')
<script>
    $(".toggle-sidebar").click(function (e) {
        $(".main-sidebar").toggleClass("open")
    });
</script>
</body>
</html>
