<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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
</head>
<body class="h-100">


<div class="container-fluid">
    <div class="h-100 no-gutters row">
        <div class="auth-form mx-auto mt-3 col-md-5 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="auth-form__title text-center mb-4">Access Your Account</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group"><label class="custom-control custom-checkbox"><input
                                    id="dr-checkbox-dCBByBa_x" type="checkbox" name="remember"
                                    class="custom-control-input" {{ old('remember') ? 'checked' : '' }}><label
                                    id="dr-checkbox-dCBByBa_x"
                                    class="custom-control-label"
                                    aria-hidden="true"></label><span
                                    class="custom-control-description">Remember me</span></label>
                        </div>

                        <div class="form-group row mb-0">
                            <button type="submit" class="d-table mx-auto btn btn-warning text-white btn-pill">
                                {{ __('Access Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
</body>
</html>
