<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-mask-plugin.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('dataTable/jquery.dataTables.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('dataTable/dataTables.bootstrap4.min.js') }}" charset="UTF-8"></script>
    <script src="/js/feather.js"></script>

    <script type="text/javascript" class="init">
        $(document).ready(function($) {
            $('#unidadetable').DataTable();
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @section('style')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('dataTable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @show
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                        </li>

                        <li class="nav-item d-md-none">
                            <a class="nav-link active" href="dashboard">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link" href="{{action('UnidadeController@list')}}">
                                <span data-feather="users"></span>
                                Adms
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link">
                                <span data-feather="alert-triangle"></span>
                                Denuncias
                            </a>
                        </li>
                        <li class="d-block d-md-none">
                            <a class="nav-link">
                                <span data-feather="check-square"></span>
                                Ativaçao
                            </a>
                        </li>

                        @endif
                        @else


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row m-0 ">
            <nav class="col-xl-2 col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column pt-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard">
                                <i data-feather="home"></i>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{action('UnidadeController@list')}}">
                                <span data-feather="users"></span>
                                Adms
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <span data-feather="alert-triangle"></span>
                                Denuncias
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <span data-feather="check-square"></span>
                                Ativaçao
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Administraçao</span>
                        <a class="d-flex align-items-center text-muted" href="">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="settings"></span>
                                Configuraçao
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-xl-10 col-md-12 pl-3 pr-3  ">
                @yield('content')
            </main>
        </div>
    </div>
</body>

<script>
    feather.replace({
        width: 24,
        height: 24,
        stroke: '#888888',
        'stroke-width': 2,
    });
</script>

</html>