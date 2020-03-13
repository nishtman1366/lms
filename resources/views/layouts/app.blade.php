<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>بانک دریافت جزوات الکترونیک | دانشگاه علوم کشاورزی و منابع طبیعی گرگان</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <style>
        .nav-link[data-toggle].collapsed:after {
            content: " ▾";
        }

        .nav-link[data-toggle]:not(.collapsed):after {
            content: " ▴";
        }
    </style>
</head>
<body>
<div id="app">
    <div class="container-fluid">
        @auth
            <div class="row">
                <div class="col-12 col-sm-3 col-md-2 collapse show d-md-flex pt-2 pl-0 min-vh-100 bg-dark" id="sidebar">
                    @include('layouts.sidebar')
                </div>
                <div class="col-12 col-sm-9 col-md-10">
                    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <h4>بانک دریافت جزوات الکترونیک</h4>
                            <h5>دانشگاه علوم کشاورزی و منابع طبیعی گرگان</h5>
                        </a>
                    </nav>
                    <div class="container-fluid my-5">
                        @if(!is_null(old('message')))
                            <div class="alert alert-{{!is_null(old('messageType')) ? old('messageType') : 'success'}} my-5">
                                {{old('message')}}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        @endauth
        @guest
            @yield('content')
        @endguest
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>
