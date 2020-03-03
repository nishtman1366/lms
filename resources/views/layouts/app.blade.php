<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>بانک دریافت جزوات الکترونیک | دانشگاه علوم کشاورزی و منابع طبیعی گرگان</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <a class="navbar-brand" href="{{ url('/') }}">
                <h4>بانک دریافت جزوات الکترونیک</h4>
                <h5>دانشگاه علوم کشاورزی و منابع طبیعی گرگان</h5>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @auth
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">صفحه اصلی</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="learningDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>آموزش</a>
                            <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="learningDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard.professors.list') }}">مدیریت اساتید</a>
                                <a class="dropdown-item" href="{{ route('dashboard.lessons.list') }}">مدیریت دروس</a>
                                <a class="dropdown-item" href="{{ route('dashboard.documents.list') }}">مدیریت کلاس ها</a>
                                <a class="dropdown-item" href="{{ route('dashboard.documents.list') }}">مدیریت جزوات</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.users.list') }}">مدیریت کاربران</a>
                        </li>
                    </ul>
            @endauth
            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ورود به سیستم</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </nav>
    </div>
    <div class="container my-5">
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
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>
