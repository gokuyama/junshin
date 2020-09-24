<?php

use junshin\UserPorPerfil;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $usuario = \Auth::user();
    $manutencao = false;
    $administrador = false;
    $secretaria = false;
    $balancete = false;
    $professor = false;
    if ($usuario) {
        $perfis = UserPorPerfil::where('user_id', $usuario->id)->where('ativo', 1)->get(['perfil_id']);
        if ($perfis->contains('perfil_id', '1')) {
            $manutencao = true;
            Session::put('manutencao', $manutencao);
        }
        if ($perfis->contains('perfil_id', '2')) {
            $administrador = true;
            Session::put('administrador', $administrador);
        }
        if ($perfis->contains('perfil_id', '3')) {
            $secretaria = true;
            Session::put('secretaria', $secretaria);
        }
        if ($perfis->contains('perfil_id', '4')) {
            $balancete = true;
            Session::put('balancete', $balancete);
        }
        if ($perfis->contains('perfil_id', '5')) {
            $professor = true;
            Session::put('professor', $professor);
        }
        return view('home')
            ->with('manutencao', $manutencao)
            ->with('administrador', $administrador)
            ->with('secretaria', $secretaria)
            ->with('balancete', $balancete)
            ->with('professor', $professor);
    } else {
        return view('home');
    }
});

Route::get('/alunos', ['as' => 'alunos', 'uses' => 'AlunoController@lista']);

Route::get('/alunos/localiza', 'AlunoController@localiza');
Route::post('/alunos/adiciona', ['as' => 'alunos.adiciona', 'uses' => 'AlunoController@adiciona']);
Route::get('/alunos/novo', ['as' => 'alunos.novo', 'uses' => 'AlunoController@novo']);
Route::get('/alunos/exclui/{aluno_id}', 'AlunoController@exclui');
Route::get('/alunos/altera/{aluno_id}', 'AlunoController@altera');
Route::get('/alunos/edita/{aluno_id}', 'AlunoController@edita');

Route::get('/responsaveis/localiza', 'ResponsavelController@localiza');
Route::get('/responsaveis/localizaPorAluno/{aluno_id}', 'ResponsavelController@localizaResponsavelPorAluno');
Route::get('/responsaveis/novoResponsavelPorAluno/{aluno_id}', 'ResponsavelController@novoResponsavelPorAluno');
Route::get('/responsaveis', ['as' => 'responsaveis.lista', 'uses' => 'ResponsavelController@lista']);
Route::post('/responsaveis/adiciona', ['as' => 'responsaveis.adiciona', 'uses' => 'ResponsavelController@adiciona']);
Route::get('/responsaveis/novo', ['as' => 'responsaveis.novo', 'uses' => 'ResponsavelController@novo']);
Route::get('/responsaveis/edita/{responsavel_id}', 'ResponsavelController@edita');
Route::get('/responsaveis/altera/{responsavel_id}', 'ResponsavelController@altera');
Route::get('/responsaveis/exclui/{responsavel_id}', 'ResponsavelController@exclui');

Route::get('/moradores/localiza', 'MoradorController@localiza');
Route::get('/moradores/localizaPorAluno/{aluno_id}', 'MoradorController@localizaMoradorPorAluno');
Route::get('/moradores/novoMoradorPorAluno/{aluno_id}', 'MoradorController@novoMoradorPorAluno');
Route::get('/moradores', ['as' => 'moradores.lista', 'uses' => 'MoradorController@lista']);
Route::post('/moradores/adiciona', ['as' => 'moradores.adiciona', 'uses' => 'MoradorController@adiciona']);
Route::get('/moradores/novo', ['as' => 'moradores.novo', 'uses' => 'MoradorController@novo']);
Route::get('/moradores/edita/{morador_id}', 'MoradorController@edita');
Route::get('/moradores/altera/{morador_id}', 'MoradorController@altera');
Route::get('/moradores/exclui/{morador_id}', 'MoradorController@exclui');

Route::get('/historicos/localiza', 'HistoricoController@localiza');
Route::get('/historicos/localizaPorAluno/{aluno_id}', 'HistoricoController@localizaHistoricoPorAluno');
Route::get('/historicos/novoMoradorPorAluno/{aluno_id}', 'HistoricoController@novoHistoricoPorAluno');
Route::get('/historicos', ['as' => 'historicos.lista', 'uses' => 'HistoricoController@lista']);
Route::post('/historicos/adiciona', ['as' => 'historicos.adiciona', 'uses' => 'HistoricoController@adiciona']);
Route::get('/historicos/novo', ['as' => 'historicos.novo', 'uses' => 'HistoricoController@novo']);
Route::get('/historicos/edita/{historico_instituicao_id}', 'HistoricoController@edita');
Route::get('/historicos/altera/{historico_instituicao_id}', 'HistoricoController@altera');
Route::get('/historicos/exclui/{historico_instituicao_id}', 'HistoricoController@exclui');


Route::get('/turmas', ['as' => 'turmas.lista', 'uses' => 'TurmaController@lista']);
Route::post('/turmas/adiciona', ['as' => 'turmas.adiciona', 'uses' => 'TurmaController@adiciona']);
Route::get('/turmas/novo', ['as' => 'turmas.novo', 'uses' => 'TurmaController@novo']);
Route::get('/turmas/edita/{turma_id}', 'TurmaController@edita');
Route::get('/turmas/altera/{turma_id}', 'TurmaController@altera');
Route::get('/turmas/exclui/{turma_id}', 'TurmaController@exclui');
Route::get('/turmas/listaAlunos/{turma_id}', 'TurmaController@listaAlunos');

Route::get('/matriculas', ['as' => 'matriculas.lista', 'uses' => 'MatriculaController@lista']);
Route::post('/matriculas/adiciona', ['as' => 'matriculas.adiciona', 'uses' => 'MatriculaController@adiciona']);
Route::get('/matriculas/novo', ['as' => 'matriculas.novo', 'uses' => 'MatriculaController@novo']);
Route::get('/matriculas/edita/{matricula_id}', 'MatriculaController@edita');
Route::get('/matriculas/altera/{matricula_id}', 'MatriculaController@altera');
Route::get('/matriculas/exclui/{matricula_id}', 'MatriculaController@exclui');
Route::get('/matriculas/finaliza/{matricula_id}', 'MatriculaController@finaliza');
Route::get('/matriculas/localizaPorAluno/{aluno_id}', 'MatriculaController@localizaMatriculaPorAluno');
Route::get('/matriculas/novaMatriculaPorAluno/{aluno_id}', 'MatriculaController@novaMatriculaPorAluno');

Route::post('/mensalidades/adiciona', ['as' => 'mensalidades.adiciona', 'uses' => 'MensalidadeController@adiciona']);
Route::get('/mensalidades/novo/{matricula_id}', 'MensalidadeController@novo');

Route::get('/relatorios/relatoriosPorAluno/{aluno_id}', 'RelatorioController@listaPorAluno');
Route::get('/relatorios/relatoriosPorTurma/{turma_id}', 'RelatorioController@listaPorTurma');
Route::get('/relatorios/print-pdf', ['as' => 'relatorio.printpdf', 'uses' => 'RelatorioController@printPDF']);
Route::get('/relatorios/declaracao', ['as' => 'relatorio.declaracao', 'uses' => 'RelatorioController@declaracao']);
Route::get('/relatorios/declaracaoMatricula/{aluno_id}', 'RelatorioController@declaracaoMatricula');
Route::get('/relatorios/declaracaoAdimplencia/{aluno_id}', 'RelatorioController@declaracaoAdimplencia');
Route::get('/relatorios/listaChamada/{turma_id}', 'RelatorioController@listaChamada');
Route::get('/relatorios/fichaMatriculaEdInfant', 'RelatorioController@fichaMatriculaEducacaoInfantil');
Route::get('/relatorios/fichaMatriculaEdInfantPreenchida/{aluno_id}', 'RelatorioController@fichaMatriculaEdInfantPreenchida');
Route::get('/relatorios/fichaMatriculaCursoJap', 'RelatorioController@fichaMatriculaCursoJapones');
Route::get('/relatorios/fichaMatriculaCursoJapPreenchida/{aluno_id}', 'RelatorioController@fichaMatriculaCursoJapPreenchida');

Route::get('/dominios', 'DominioController@mostra');

Route::get('/tiposDocumento', ['as' => 'tiposDocumento.lista', 'uses' => 'TipoDocumentoController@lista']);
Route::post('/tiposDocumento/adiciona', ['as' => 'tiposDocumento.adiciona', 'uses' => 'TipoDocumentoController@adiciona']);
Route::get('/tiposDocumento/novo', ['as' => 'tiposDocumento.novo', 'uses' => 'TipoDocumentoController@novo']);
Route::get('/tiposDocumento/edita/{tipo_documento_id}', 'TipoDocumentoController@edita');
Route::get('/tiposDocumento/altera/{tipo_documento_id}', 'TipoDocumentoController@altera');
Route::get('/tiposDocumento/exclui/{tipo_documento_id}', 'TipoDocumentoController@exclui');

Route::get('/tiposResponsavel', ['as' => 'tiposResponsavel.lista', 'uses' => 'TipoResponsavelController@lista']);
Route::post('/tiposResponsavel/adiciona', ['as' => 'tiposResponsavel.adiciona', 'uses' => 'TipoResponsavelController@adiciona']);
Route::get('/tiposResponsavel/novo', ['as' => 'tiposResponsavel.novo', 'uses' => 'TipoResponsavelController@novo']);
Route::get('/tiposResponsavel/edita/{tipo_responsavel_id}', 'TipoResponsavelController@edita');
Route::get('/tiposResponsavel/altera/{tipo_responsavel_id}', 'TipoResponsavelController@altera');
Route::get('/tiposResponsavel/exclui/{tipo_responsavel_id}', 'TipoResponsavelController@exclui');

Route::get('/tiposFrequencia', ['as' => 'tiposFrequencia.lista', 'uses' => 'TipoFrequenciaController@lista']);
Route::post('/tiposFrequencia/adiciona', ['as' => 'tiposFrequencia.adiciona', 'uses' => 'TipoFrequenciaController@adiciona']);
Route::get('/tiposFrequencia/novo', ['as' => 'tiposFrequencia.novo', 'uses' => 'TipoFrequenciaController@novo']);
Route::get('/tiposFrequencia/edita/{tipo_frequencia_id}', 'TipoFrequenciaController@edita');
Route::get('/tiposFrequencia/altera/{tipo_frequencia_id}', 'TipoFrequenciaController@altera');
Route::get('/tiposFrequencia/exclui/{tipo_frequencia_id}', 'TipoFrequenciaController@exclui');

Route::get('/tiposTurma', ['as' => 'tiposTurma.lista', 'uses' => 'TipoTurmaController@lista']);
Route::post('/tiposTurma/adiciona', ['as' => 'tiposTurma.adiciona', 'uses' => 'TipoTurmaController@adiciona']);
Route::get('/tiposTurma/novo', ['as' => 'tiposTurma.novo', 'uses' => 'TipoTurmaController@novo']);
Route::get('/tiposTurma/edita/{tipo_turma_id}', 'TipoTurmaController@edita');
Route::get('/tiposTurma/altera/{tipo_turma_id}', 'TipoTurmaController@altera');
Route::get('/tiposTurma/exclui/{tipo_turma_id}', 'TipoTurmaController@exclui');


Route::get('/niveisEscolaridade', ['as' => 'niveisEscolaridade.lista', 'uses' => 'NivelEscolaridadeController@lista']);
Route::post('/niveisEscolaridade/adiciona', ['as' => 'niveisEscolaridade.adiciona', 'uses' => 'NivelEscolaridadeController@adiciona']);
Route::get('/niveisEscolaridade/novo', ['as' => 'niveisEscolaridade.novo', 'uses' => 'NivelEscolaridadeController@novo']);
Route::get('/niveisEscolaridade/edita/{nivel_escolaridade_id}', 'NivelEscolaridadeController@edita');
Route::get('/niveisEscolaridade/altera/{nivel_escolaridade_id}', 'NivelEscolaridadeController@altera');
Route::get('/niveisEscolaridade/exclui/{nivel_escolaridade_id}', 'NivelEscolaridadeController@exclui');

Route::get('/niveisConhecimentoJapones', ['as' => 'niveisConhecimentoJapones.lista', 'uses' => 'NivelConhecimentoJaponesController@lista']);
Route::post('/niveisConhecimentoJapones/adiciona', ['as' => 'niveisConhecimentoJapones.adiciona', 'uses' => 'NivelConhecimentoJaponesController@adiciona']);
Route::get('/niveisConhecimentoJapones/novo', ['as' => 'niveisConhecimentoJapones.novo', 'uses' => 'NivelConhecimentoJaponesController@novo']);
Route::get('/niveisConhecimentoJapones/edita/{nivel_conhecimento_japones_id}', 'NivelConhecimentoJaponesController@edita');
Route::get('/niveisConhecimentoJapones/altera/{nivel_conhecimento_japones_id}', 'NivelConhecimentoJaponesController@altera');
Route::get('/niveisConhecimentoJapones/exclui/{nivel_conhecimento_japones_id}', 'NivelConhecimentoJaponesController@exclui');

Route::get('/turnos', ['as' => 'turnos.lista', 'uses' => 'TurnoController@lista']);
Route::post('/turnos/adiciona', ['as' => 'turnos.adiciona', 'uses' => 'TurnoController@adiciona']);
Route::get('/turnos/novo', ['as' => 'turnos.novo', 'uses' => 'TurnoController@novo']);
Route::get('/turnos/edita/{turno_id}', 'TurnoController@edita');
Route::get('/turnos/altera/{turno_id}', 'TurnoController@altera');
Route::get('/turnos/exclui/{turno_id}', 'TurnoController@exclui');

//Auth::routes();
//desabilita o registro de novos usuários
//Disable Reset Password
Auth::routes(['reset' => false]);
Route::get('/usuario/edita', ['as' => 'usuario.edita', 'uses' => 'UsuarioController@edita']);
Route::get('/usuario/seleciona', 'UsuarioController@seleciona');
Route::get('/usuario/alteraUsuario/{id}', 'UsuarioController@alteraUsuario');
Route::get('/usuario/exclui/{id}', 'UsuarioController@exclui');
Route::get('/usuario/alteraSenha',  ['as' => 'usuario.alteraSenha', 'uses' => 'UsuarioController@alteraSenha']);
Route::get('/usuario/editaSenha',  'UsuarioController@editaSenha');
Route::get('/usuario/redefineSenha/{id}', 'UsuarioController@redefineSenha');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tiposTurma', ['as' => 'tiposTurma.lista', 'uses' => 'TipoTurmaController@lista']);
Route::post('/tiposTurma/adiciona', ['as' => 'tiposTurma.adiciona', 'uses' => 'TipoTurmaController@adiciona']);
Route::get('/tiposTurma/novo', ['as' => 'tiposTurma.novo', 'uses' => 'TipoTurmaController@novo']);
Route::get('/tiposTurma/edita/{tipo_turma_id}', 'TipoTurmaController@edita');
Route::get('/tiposTurma/altera/{tipo_turma_id}', 'TipoTurmaController@altera');
Route::get('/tiposTurma/exclui/{tipo_turma_id}', 'TipoTurmaController@exclui');


Route::get('/niveisEscolaridade', ['as' => 'niveisEscolaridade.lista', 'uses' => 'NivelEscolaridadeController@lista']);
Route::post('/niveisEscolaridade/adiciona', ['as' => 'niveisEscolaridade.adiciona', 'uses' => 'NivelEscolaridadeController@adiciona']);
Route::get('/niveisEscolaridade/novo', ['as' => 'niveisEscolaridade.novo', 'uses' => 'NivelEscolaridadeController@novo']);
Route::get('/niveisEscolaridade/edita/{nivel_escolaridade_id}', 'NivelEscolaridadeController@edita');
Route::get('/niveisEscolaridade/altera/{nivel_escolaridade_id}', 'NivelEscolaridadeController@altera');
Route::get('/niveisEscolaridade/exclui/{nivel_escolaridade_id}', 'NivelEscolaridadeController@exclui');

Route::get('/niveisConhecimentoJapones', ['as' => 'niveisConhecimentoJapones.lista', 'uses' => 'NivelConhecimentoJaponesController@lista']);
Route::post('/niveisConhecimentoJapones/adiciona', ['as' => 'niveisConhecimentoJapones.adiciona', 'uses' => 'NivelConhecimentoJaponesController@adiciona']);
Route::get('/niveisConhecimentoJapones/novo', ['as' => 'niveisConhecimentoJapones.novo', 'uses' => 'NivelConhecimentoJaponesController@novo']);
Route::get('/niveisConhecimentoJapones/edita/{nivel_conhecimento_japones_id}', 'NivelConhecimentoJaponesController@edita');
Route::get('/niveisConhecimentoJapones/altera/{nivel_conhecimento_japones_id}', 'NivelConhecimentoJaponesController@altera');
Route::get('/niveisConhecimentoJapones/exclui/{nivel_conhecimento_japones_id}', 'NivelConhecimentoJaponesController@exclui');

Route::get('/turnos', ['as' => 'turnos.lista', 'uses' => 'TurnoController@lista']);
Route::post('/turnos/adiciona', ['as' => 'turnos.adiciona', 'uses' => 'TurnoController@adiciona']);
Route::get('/turnos/novo', ['as' => 'turnos.novo', 'uses' => 'TurnoController@novo']);
Route::get('/turnos/edita/{turno_id}', 'TurnoController@edita');
Route::get('/turnos/altera/{turno_id}', 'TurnoController@altera');
Route::get('/turnos/exclui/{turno_id}', 'TurnoController@exclui');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/boletos', ['as' => 'boletos.lista', 'uses' => 'BoletoController@listaPorAluno']);
Route::get('/boletos/seleciona', ['as' => 'boletos.seleciona', 'uses' => 'BoletoController@selecionarOpcao']);
Route::get('/boletos/retorno', ['as' => 'boletos.retorno', 'uses' => 'BoletoController@processaRetorno']);
Route::get('/boletos/imprimeBoleto/{aluno_id}', 'BoletoController@imprimeBoleto');
Route::get('/boletos', 'BoletoController@listaPorAluno');

Route::get('/tiposMovimentacao', ['as' => 'tiposMovimentacao.lista', 'uses' => 'TipoMovimentacaoController@lista']);
Route::post('/tiposMovimentacao/adiciona', ['as' => 'tiposMovimentacao.adiciona', 'uses' => 'TipoMovimentacaoController@adiciona']);
Route::get('/tiposMovimentacao/novo', ['as' => 'tiposMovimentacao.novo', 'uses' => 'TipoMovimentacaoController@novo']);
Route::get('/tiposMovimentacao/edita/{tipo_movimentacao_id}', 'TipoMovimentacaoController@edita');
Route::get('/tiposMovimentacao/altera/{tipo_movimentacao_id}', 'TipoMovimentacaoController@altera');
Route::get('/tiposMovimentacao/exclui/{tipo_movimentacao_id}', 'TipoMovimentacaoController@exclui');

Route::get('/movimentacoes', ['as' => 'movimentacoes.lista', 'uses' => 'MovimentacaoController@lista']);
Route::get('/movimentacoes/entradas', ['as' => 'movimentacoes.lista.entradas', 'uses' => 'MovimentacaoController@listaEntradas']);
Route::get('/movimentacoes/saidas', ['as' => 'movimentacoes.lista.saidas', 'uses' => 'MovimentacaoController@listaSaidas']);
Route::post('/movimentacoes/adiciona/entrada', ['as' => 'movimentacoes.adiciona.entrada', 'uses' => 'MovimentacaoController@adicionaEntrada']);
Route::post('/movimentacoes/adiciona/saida', ['as' => 'movimentacoes.adiciona.saida', 'uses' => 'MovimentacaoController@adicionaSaida']);
Route::get('/movimentacoes/nova/entrada', ['as' => 'movimentacoes.nova.entrada', 'uses' => 'MovimentacaoController@novaEntrada']);
Route::get('/movimentacoes/nova/saida', ['as' => 'movimentacoes.nova.saida', 'uses' => 'MovimentacaoController@novaSaida']);
Route::get('/movimentacoes/edita/entrada/{movimentacao_id}', 'MovimentacaoController@editaEntrada');
Route::get('/movimentacoes/edita/saida/{movimentacao_id}', 'MovimentacaoController@editaSaida');
Route::get('/movimentacoes/altera/entrada/{movimentacao_id}', 'MovimentacaoController@alteraEntrada');
Route::get('/movimentacoes/altera/saida/{movimentacao_id}', 'MovimentacaoController@alteraSaida');
Route::get('/movimentacoes/exclui/entrada/{movimentacao_id}', 'MovimentacaoController@excluiEntrada');
Route::get('/movimentacoes/exclui/saida/{movimentacao_id}', 'MovimentacaoController@excluiSaida');
Route::get('/movimentacoes/pdf', ['as' => 'movimentacoes.pdf', 'uses' => 'MovimentacaoController@relatorioMovimentacao']);
