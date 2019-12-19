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
    <!-- datepicker -->
    <link href="{{ asset('css/bootstrap-datepicker.standalone.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <title>JUNSHIN | Imaculado Coração</title>
</head>

<body>
    <div id="app">
        <ul id="main-menu" class="sm sm-blue">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><span class="fas fa-sign-in-alt"></span>
                    {{ __('Login') }}</a>
            </li>
            @endguest
            @auth
            <li><a href="/"><span class="fas fa-home"></span> Página Inicial</a>
            </li>
            @if (
            Session::get('manutencao')||Session::get('administrador')||Session::get('secretaria')||Session::get('professor'))
            <li><a href="#"> <span class="fas fa-user-graduate"></span> Alunos</a>
                <ul>
                    <li><a href="{{route('alunos')}}">Localizar Aluno</a></li>
                    <li><a href='{{route('alunos.novo')}}'>Novo Aluno</a></li>
                    <li><a href="{{route('boletos.seleciona') }}">Boletos</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="fas fa-school"></span> Turmas</a>
                <ul>
                    <li><a href='{{route('turmas.lista')}}'>Listar Turmas</a></li>
                    <li><a href='{{route('turmas.novo')}}'>Nova Turma</a></li>
                </ul>
            </li>
            @endif
            @if (Session::get('manutencao')||Session::get('administrador')||Session::get('balancete'))
            <li><a href="#"><span class="fas fa-money-check-alt"></span> Balancete</a>
                <ul>
                    <li><a href="{{ route('movimentacoes.nova.entrada') }}">Nova entrada</a></li>
                    <li><a href="{{ route('movimentacoes.nova.saida') }}">Nova saída</a></li>
                    <li>____________________________</li>
                    <li><a href="{{ route('movimentacoes.lista.entradas') }}">Lista entradas</a></li>
                    <li><a href="{{ route('movimentacoes.lista.saidas') }}">Lista saídas</a></li>
                    <li>____________________________</li>
                    <li><a href="#" data-toggle="modal" data-target="#frmReport02">Relatórios</a></li>
                    <li>____________________________</li>
                    <li><a href="{{ route('tiposMovimentacao.lista') }}">Tipos de Movimentacoes</a></li>
                </ul>
            </li>
            @endif
            @if (Session::get('manutencao')||Session::get('administrador')||Session::get('secretaria'))
            <li><a href="#"><span class="fas fa-table"></span> Tabelas de Domínio</a>
                <ul>
                    <li><a href="{{ route('niveisConhecimentoJapones.lista') }}">Níveis de Conhecimento de Japonês</a>
                    </li>
                    <li><a href="{{ route('niveisEscolaridade.lista') }}">Níveis de Escolaridade</a></li>
                    <li><a href="{{ route('tiposDocumento.lista') }}">Tipos de Documento</a></li>
                    <li><a href="{{ route('tiposFrequencia.lista') }}">Tipos de Frequência</a></li>
                    <li><a href="{{ route('tiposResponsavel.lista') }}">Tipos de Responsável</a></li>
                    <li><a href="{{ route('tiposTurma.lista') }}">Tipos de Turma</a></li>
                    <li><a href="{{ route('turnos.lista') }}">Turnos</a></li>
                </ul>
            </li>
            @endif
            @if (Session::get('manutencao')||Session::get('administrador'))
            <li><a href="#"><span class="fas fa-users"></span> Usuários</a>
                <ul>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar Usuário') }}</a>
                    </li>
                    <li><a href="{{ route('usuario.edita') }}">Alterar Usuários</a></li>
                </ul>
            </li>
            @endif
            <li><a href="#"> <span class="fas fa-user"></span>
                    {{ Auth::user()->username }}</a>
                <ul>
                    <li><a href="{{ route('usuario.alteraSenha') }}"><span class="fas fa-key"></span>Altera Senha</a>
                    </li>
                    <li> <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            <span class="fas fa-sign-out-alt"></span>
                            Sair
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endauth
                </ul>
            </li>
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
        <!--mostra a mensagens ao usuário -->
        @if(Session::has('mensagemErro'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('mensagemErro') }}</p>
        @endif
        @if(Session::has('mensagemSucesso'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('mensagemSucesso') }}</p>
        @endif
        @yield('conteudo')
        <footer class="footer">
            <p>© Brhadoky</p>
        </footer>
    </div>

    <!-- ------------------------------------------------------------------------------------ -->

    <!-- Modal 1 -->
    <div class="modal fade" id="frmReport02" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Movimentações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="frmReport001" id="frmReport001" method="get" action="{{ route('movimentacoes.pdf') }}">
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-4">
                                <div class="form-check form-check-inline col-md-4">
                                    <input class="form-check-input" type="radio" name="radioTipoPeriodo" id="radioDia"
                                        value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Dia</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" name="dtpDia" id="dtpDia" placeholder="Dia">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-4">
                                <div class="form-check form-check-inline col-md-4">
                                    <input class="form-check-input" type="radio" name="radioTipoPeriodo"
                                        id="radioSemanaAno" value="option2">
                                    <label class="form-check-label" for="inlineRadio1">Semana</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="txtSemana" placeholder="Semana">
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" id="longAnoSemana">
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-4">
                                <div class="form-check form-check-inline col-md-4">
                                    <input class="form-check-input" type="radio" name="radioTipoPeriodo"
                                        id="radioMesAno" value="option3">
                                    <label class="form-check-label" for="inlineRadio1">Mês</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" id="longMesAno">
                                    <option value="1">JANEIRO</option>
                                    <option value="2">FEVEREIRO</option>
                                    <option value="3">MARÇO</option>
                                    <option value="4">ABRIL</option>
                                    <option value="5">MAIO</option>
                                    <option value="6">JUNHO</option>
                                    <option value="7">JULHO</option>
                                    <option value="8">AGOSTO</option>
                                    <option value="9">SETEMBRO</option>
                                    <option value="10">OUTUBRO</option>
                                    <option value="10">NOVEMBRO</option>
                                    <option value="10">DEZEMBRO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" id="longAnoMes">
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-4">
                                <div class="form-check form-check-inline col-md-4">
                                    <input class="form-check-input" type="radio" name="radioTipoPeriodo"
                                        id="radioPeriodo" value="option4">
                                    <label class="form-check-label" for="inlineRadio1">Período</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="dtpDiaIni" placeholder="Dia ini">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="dtpDiaFim" placeholder="Dia fim">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Abrir</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ------------------------------------------------------------------------------------ -->

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
jQuery(function($) {

    $('#main-menu').smartmenus();

    $('#dtpDia').datepicker({
        weekStart: 1,
        todayBtn: true,
        clearBtn: true,
        language: "pt-BR",
        daysOfWeekHighlighted: "0,6",
        calendarWeeks: true,
        todayHighlight: true
    });

});
</script>

</html>