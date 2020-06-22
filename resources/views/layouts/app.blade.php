<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vacina Garanhuns') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('dataTable/jquery.dataTables.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('dataTable/dataTables.bootstrap4.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('js/feather.js') }}"></script>
    <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>


    @stack('head')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @section('style')
    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dataTable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" rel="stylesheet">
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet">
    <style type="text/css">
        .nav-link {
            color: rgb(0, 0, 0, 0.5);
        }

        .navbar-nav>.nav-item>.nav-link.active {
            color: dodgerblue;
        }

        .nav-link:hover {
            color: rgb(0, 0, 0, 0.9);
        }
    </style>
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
                    <i class="navbar-toggler-icon"></i>
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

                        @endif
                        @else
                        <li class="nav-item d-md-none">
                            <a class="nav-link {{ Request::segment(1) === 'relatorio' ? 'active' : null }}" href="{{action('RelatorioController@list')}}">
                                <i class="fas fa-chart-bar  fa-lg "></i>
                                Relatórios
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link {{ Request::segment(1) === 'unidade' ? 'active' : null }}" href="{{action('UnidadeController@list')}}">
                                <i class="fas fa-hospital fa-lg"></i>
                                Unidades
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link {{ Request::segment(1) === 'segmento' ? 'active' : null }}" href="{{action('SegmentoController@listFull')}}">
                                <i class="fas fa-notes-medical fa-lg"></i>
                                Segmentações
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link {{ Request::segment(1) === 'solicitacao' ? 'active' : null }}" href="{{action('SolicitacaoController@list')}}">
                                <i class="fas fa-syringe fa-lg"></i>
                                Solicitações
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link {{ Request::segment(1) === 'paciente' ? 'active' : null }}" href="{{action('PacienteController@list')}}">
                                <i class="fas fa-procedures fa-lg"></i>
                                Pacientes
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link {{ Request::segment(1) === 'agente' ? 'active' : null }}" href="{{action('AgenteController@list')}}">
                                <i class=" fas fa-user-nurse fa-lg"></i>
                                Agentes
                            </a>
                        </li>

                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class=" fas fa-user-cog fa-lg"></i>
                                Administração
                            </a>

                            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">

                                <a class="dropdown-item {{ Request::segment(1) === 'conta' ? 'active' : null }}" href="{{route('conta.route', Auth::user()->id )}}">
                                    <i class="fas fa-cog fa-1x "></i>
                                    Conta
                                </a>
                                @can('create', App\Campanha::class)
                                <a class="dropdown-item {{ Request::segment(1) === 'campanha' ? 'active' : null }}" href="{{action('CampanhaController@list')}}">
                                    <i class="fas fa-cog fa-1x "></i>
                                    Conf-Campanhas
                                </a>
                                @endcan
                                @can('create', App\Termo::class)
                                <a class="dropdown-item {{ Request::segment(1) === 'termo' ? 'active' : null }}" href="{{action('TermoController@list')}}">
                                    <i class="fas fa-cog fa-1x "></i>
                                    Conf-Termos
                                </a>
                                @endcan
                                @can('create', App\Publico::class)
                                <a class="dropdown-item {{ Request::segment(1) === 'publico' ? 'active' : null }}" href="{{action('PublicoController@list')}}">
                                    <i class="fas fa-cog fa-1x "></i>
                                    Conf-Públicos
                                </a>
                                @endcan
                                @can('create', App\Idade::class)
                                <a class="dropdown-item {{ Request::segment(1) === 'idade' ? 'active' : null }}" href="{{action('IdadeController@list')}}">
                                    <i class="fas fa-cog fa-1x "></i>
                                    Conf-Idades
                                </a>
                                @endcan
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->nome }} <i class="caret"></i>
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
                    <ul class="navbar-nav flex-column pt-3 pl-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'relatorio' ? 'active' : null }}" href="{{action('RelatorioController@list')}}">
                                <i class="fas fa-chart-bar  fa-lg "></i>
                                Relatórios
                            </a>
                        </li>
                        @can('create', App\Unidade::class)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'unidade' ? 'active' : null }}" href="{{action('UnidadeController@list')}}">
                                <i class="fas fa-hospital fa-lg"></i>
                                Unidades
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'segmento' ? 'active' : null }}" href="{{action('SegmentoController@listFull')}}">
                                <i class="fas fa-notes-medical fa-lg"></i>
                                Segmentações
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'solicitacao' ? 'active' : null }}" href="{{action('SolicitacaoController@list')}}">
                                <i class="fas fa-syringe fa-lg"></i>
                                Solicitações
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'paciente' ? 'active' : null }}" href="{{action('PacienteController@list')}}">
                                <i class="fas fa-procedures fa-lg"></i>
                                Pacientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'agente' ? 'active' : null }}" href="{{action('AgenteController@list')}}">
                                <i class="fas fa-user-nurse fa-lg"></i>
                                Agentes
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <i>Administração</i>
                        <!-- <a class="d-flex align-items-center text-muted" href="">
                            <i data-feather="plus-circle"></i>
                        </a> -->
                    </h6>
                    <ul class="navbar-nav flex-column mb-2 pl-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) === 'conta' ? 'active' : null }}" href="{{route('conta.route', Auth::user()->id )}}">
                                <i class="fas fa-cog fa-1x "></i>
                                Conta
                            </a>
                            @can('create', App\Campanha::class)
                            <a class="nav-link {{ Request::segment(1) === 'campanha' ? 'active' : null }}" href="{{action('CampanhaController@list')}}">
                                <i class="fas fa-cog fa-1x "></i>
                                Conf-Campanhas
                            </a>
                            @endcan
                            @can('create', App\Termo::class)
                            <a class="nav-link {{ Request::segment(1) === 'termo' ? 'active' : null }}" href="{{action('TermoController@list')}}">
                                <i class="fas fa-cog fa-1x "></i>
                                Conf-Termos
                            </a>
                            @endcan
                            @can('create', App\Publico::class)
                            <a class="nav-link {{ Request::segment(1) === 'publico' ? 'active' : null }}" href="{{action('PublicoController@list')}}">
                                <i class="fas fa-cog fa-1x "></i>
                                Conf-Públicos
                            </a>
                            @endcan
                            @can('create', App\Idade::class)
                            <a class="nav-link {{ Request::segment(1) === 'idade' ? 'active' : null }}" href="{{action('IdadeController@list')}}">
                                <i class="fas fa-cog fa-1x "></i>
                                Conf-Idades
                            </a>
                            @endcan
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

<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    feather.replace({
        width: 24,
        height: 24,
        stroke: '#888888',
        'stroke-width': 2,
    });
</script>

</html>