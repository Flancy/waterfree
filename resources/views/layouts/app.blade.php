<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(env('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Waterfree') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/ico">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="app">
        <nav class="navigation navigation-left">
            <a href="#" class="navigation-left--header">
                <object type="image/svg+xml" data="{{ asset('images/ico/navigation-left/menu-line.svg') }}">
                    <img src="{{ asset('images/ico/navigation-left/menu-line.png') }}" class="ïmg-fluid">
                </object>
            </a>
            <ul class="navigation-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link active">
                        <object type="image/svg+xml" data="{{ asset('images/ico/navigation-left/link-water.svg') }}">
                            <img src="{{ asset('images/ico/navigation-left/link-water.png') }}" class="ïmg-fluid">
                        </object>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="content-center">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/firm_default.svg') }}" alt="Waterfree" class="img-fluid">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="smallDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Выберите город
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-center dropdown-menu-sm" aria-labelledby="smallDropdown">
                                        <div class="dropdown-item">
                                            <input type="search" class="form-control search" placeholder="Название города" autofocus="autofocus">
                                        </div>
                                        <div class="menuItems">
                                            @foreach ($citiesHeader as $city)
                                                <a class="dropdown-item" href="{{ route('set_citie', $city->name) }}">
                                                    <div class="dropdown-item-content">
                                                        <p class="dropdown-item-title">
                                                            {{ $city->name }}
                                                        </p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        <div style="display:none;" class="dropdown-header dropdown_empty">Ничего не найдено</div>
                                    </div>
                                </div>
                            </li>
                            @auth
                                @if (Auth::user()->role === 0)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.home') }}" class="nav-link">Администрирование</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="{{ route('pages.service.index') }}" class="nav-link">О сервисе</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pages.contacts.index') }}" class="nav-link">Контакты</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart.index') }}" class="nav-link nav-link_cart">
                                    <span class="nav-link--ico">@include('layouts.svg-icons.header-top-add-to-cart')</span>
                                </a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a href="
                                    @if(Auth::user()->role === 2)
                                        {{ route('user.firm.orders.index') }}
                                    @else
                                        {{ route('user.home') }}
                                    @endif" class="nav-link nav-link_profile">
                                        <span class="nav-link--ico">@include('layouts.svg-icons.header-top-user-profile')</span>
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>
        </div>

        <nav class="navigation navigation-right non-active">
            <!-- Authentication Links -->
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item dropdown">
                        <a id="navbarDropdownAuth" class="nav-link dropdown-toggle navigation-left--header" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <object type="image/svg+xml" data="{{ asset('images/ico/navigation-right/login.svg') }}" class="nav-link--ico">
                                <img src="{{ asset('images/ico/navigation-right/login.png') }}" class="ïmg-fluid">
                            </object>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownAuth">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Вход') }}</a>

                            @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            @endif
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdownSetting" class="nav-link dropdown-toggle navigation-left--header" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <object type="image/svg+xml" data="{{ asset('images/ico/navigation-right/gear.svg') }}" class="nav-link--ico">
                                <img src="{{ asset('images/ico/navigation-right/gear.png') }}" class="ïmg-fluid">
                            </object>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownSetting">
                            <a class="dropdown-item" href="
                            @if(Auth::user()->role === 2)
                                {{ route('user.firm.setting.index') }}
                            @else
                                {{ route('user.orders.index') }}
                            @endif">
                                {{ __('Личный кабинет') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 text-center">
                    <div class="footer-wrap">
                        <p class="footer-text-head">О компании</p>

                        <a href="{{ route('pages.service.index') }}" class="footer-link">О нас</a>
                        <a href="{{ route('pages.contacts.index') }}" class="footer-link">Контакты</a>
                    </div>
                </div>
                <div class="col-sm-2 text-center">
                    <div class="footer-wrap">
                        <p class="footer-text-head">Дилерам</p>

                        <a href="{{ route('pages.diler.index') }}" class="footer-link">Оставить заявку</a>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img src="{{ asset('images/firm_default.svg') }}" class="ïmg-fluid">
                    </a>
                    <p class="footer-copyright">©2019-2020 Waterfree. All Rights Reserved.</p>
                </div>
                <div class="col-sm-2 text-center">
                    <div class="footer-wrap">
                        <p class="footer-text-head">Покупателям</p>

                        <a href="{{ route('pages.promo.index') }}" class="footer-link">Промокоды</a>
                    </div>
                </div>
                <div class="col-sm-2 text-center">
                    <div class="footer-wrap">
                        <p class="footer-text-head">Сервис</p>

                        <a href="{{ route('pages.review.index') }}" class="footer-link">Оставить отзыв</a>
                        <a href="{{ route('pages.review.index') }}" class="footer-link">Пожелание к работе</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @include('modals.city')

    <script src="https://api-maps.yandex.ru/2.1/?apikey=975e872d-c3c6-4768-9569-dc49e52afa62
&lang=ru_RU" type="text/javascript"></script>
    <script scr="{{ asset('js/app.js') }}"></script>
</body>
</html>
