<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/junshin_logo_2.png') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <!-- SmartMenus core CSS (required) -->
    <link href="{{ asset('css/sm-core-css.css') }}" rel='stylesheet' type='text/css' />
    <!-- "sm-blue" menu theme (optional, you can use your own CSS, too) -->
    <link href="{{ asset('css/sm-blue.css') }}" rel='stylesheet' type='text/css' />
    <title>JUNSHIN | Imaculado Coração</title>
</head>

<body>
    <div id="app">
        <ul id="main-menu" class="sm sm-blue">
            <li><a href="/">Página Inicial</a>
            </li>
            <li><a href="#">Alunos</a>
                <ul>
                    <li><a href="{{route('alunos')}}">Localizar Aluno</a></li>
                    <li><a href='{{route('alunos.novo')}}'>Novo Aluno</a></li>
                </ul>
            </li>
            <li><a href="#">Turmas</a>
                <ul>
                    <li><a href='{{route('turmas.lista')}}'>Listar Turmas</a></li>
                    <li><a href='{{route('turmas.novo')}}'>Nova Turma</a></li>
                </ul>
            </li>
            <li><a href="#">Tabelas de Domínio</a>
                <ul>
                    <li><a href="{{ route('niveisConhecimentoJapones.lista') }}">Níveis de Conhecimento de Japonês</a>
                    </li>
                    <li><a href="{{ route('niveisEscolaridade.lista') }}">Níveis de Escolaridade</a></li>
                    <li><a href="{{ route('tiposDocumento.lista') }}">Tipos de Documento</a></li>
                    <li><a href="{{ route('tiposFrequencia.lista') }}">Tipos de Frequência</a></li>
                    <li><a href="{{ route('tiposResponsavel.lista') }}">Tipos de Responsável</a></li>
                    <li><a href="{{ route('tiposTurma.lista') }}">Tipos de Turma</a></li>
                    <li><a href="{{ route('turnos.lista') }}">Turnos</a></li>
                    <li><a href="{{ route('boletos.lista') }}">boletos</a></li>
                </ul>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endguest
            @auth
            @if (Auth::user()->username == 'junshin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar Usuário') }}</a>
            </li>
            @endif
            <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    Logout (Usuário:{{ Auth::user()->username }})
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            @endauth
        </ul>
    </div>


    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1>
                        <img style="display: inline-block;" src="/img/junshin_logo_2.png" alt="Imagem do Junshin">
                        <a class="navbar-brand" href="/alunos">
                            ESCOLA JUNSHIN
                        </a>
                    </h1>
                </div>
            </div>
        </nav>
        @yield('conteudo')
        <footer class="footer">
            <p>© Brhadoky</p>
        </footer>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>-->
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- SmartMenus jQuery plugin -->
    <script src="{{ asset('js/jquery.smartmenus.js') }}"></script>
</body>
<script>
$(function() {
    $('#main-menu').smartmenus();
});
</script>

</html>