<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container p-0">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'LawPost') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>
                        <form class="form-group mx-2 my-auto d-inline w-50 form-group-lg" action="{{action('SearchController@search')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="searchKey" placeholder="Search">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Powered by &nbsp; <i class="fab fa-algolia" style="font-size:18px"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <div class="d-md-none">
                                <a class="nav-link" href="/">All Questions</a>
                                @auth
                                <a class="nav-link" href="/my-questions">My Questions</a>
                                @endauth
                                <a class="nav-link" href="/unsolved">Unsolved</a>
                                <a class="nav-link" href="/solved">Solved</a>
                                <a class="nav-link" href="/trash">Trash</a>
                            </div>
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="#">My Profile</a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                </div>
            </nav>
            <main class="py-5">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-lg-2 d-none d-md-block">
                            <ul class="nav flex-column sidebar sticky-top">
                                <li class="nav-item p-2">
                                    <a class="nav-link {{ request()->is('/') || request()->is('/questions') ? 'active' : '' }}"
                                        href="/">
                                        <span class="icon">
                                            <i class="fas fa-question mr-2"></i>
                                        </span>
                                        All Questions
                                    </a>
                                </li>
                                @auth
                                <li class="nav-item p-2">
                                    <a class="nav-link {{ request()->is('my-questions') ? 'active' : '' }}"
                                        href="/my-questions">
                                        <span class="icon">
                                            <i class="fas fa-question-circle mr-2"></i>
                                        </span>
                                        My Questions
                                    </a>
                                </li>
                                @endauth
                                <li class="nav-item p-2">
                                    <a class="nav-link {{ request()->is('unsolved') ? 'active' : '' }}" href="/unsolved">
                                        <span class="icon">
                                            <i class="fas fa-times-circle mr-2"></i>
                                        </span>
                                        Unsolved
                                    </a>
                                </li>
                                <li class="nav-item p-2">
                                    <a class="nav-link {{ request()->is('solved') ? 'active' : '' }}" href="/solved">
                                        <span class="icon">
                                            <i class="fas fa-check-circle mr-2"></i>
                                        </span>
                                        Solved
                                    </a>
                                </li>
                                @auth
                                <li class="nav-item p-2">
                                    <a class="nav-link {{ request()->is('trash') ? 'active' : '' }}" href="/trash">
                                        <span class="icon">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        Trash
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </div>
                        <div class="col-lg-7">
                            <div class="container">
                                @include('layouts/messages')
                            </div>
                            @yield('content')
                        </div>
                        <div class="col-lg-3 d-none d-md-block">
                            <div class="container">
                                <div class="card  border-0 text-dark bg-warning mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Warning!!!</h5>
                                        <p class="card-text">
                                            LawPost is for educational purposes only and is not a substitute for individualized advice from a qualified
                                            legal practitioner. Communications on LawPost are not privileged communications and do not create an
                                            attorney-client relationship.
                                        </p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </body>

</html>