<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>C2CD</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .content {
        margin-top: 140px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">

                 
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <div class="mr-auto flex-column">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h1>C2CD</h1>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.create')}}">{{ __('出品') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              カテゴリ
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/category/1">カテゴリー1</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/category/2">カテゴリー2</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/category/3">カテゴリー3</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/category/4">カテゴリー4</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/category/5">カテゴリー5</a>
                              <!-- <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">その他</a> -->
                            </div>
                          </li>
                          <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('search.keyword') }}">
                            @csrf
                            <input type="search" class="form-control mr-sm-2" size="80" placeholder="キーワード" aria-label="検索..." name="keyword" @isset( $keyword) value="{{ $keyword }}" @endisset>
                            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">検索</button>
                          </form>

                    

                    <!-- Right Side Of Navbar -->

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('purchase.cart') }}">{{ __('ショッピングカート') }}</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->user_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('mypage') }}"
                                    onclick="event.preventDefault();
                                                       document.getElementById('mypage').submit();">
                                        {{ __('マイページ') }}           
                                </a>  
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>
                                    <form id="mypage" action="{{ route('mypage') }}" method="GET">
                                        @csrf
                                    </form>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="content">
            @yield('content')
        </main>
    </div>
</body>
</html>
