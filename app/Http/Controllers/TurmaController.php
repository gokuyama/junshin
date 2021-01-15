<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\TurmaRequest;
use junshin\Turma;
use junshin\TipoTurma;
use junshin\Turno;
use junshin\TipoFrequencia;
use Request;
use Carbon\Carbon;

class TurmaController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $turmas = Turma::where('ativo', 1)->get();
        if (view()->exists('turma.listagemTurma')) {
            return view('turma.listagemTurma')->with('turmas', $turmas);
        }
    }

    public function listaAlunos($turma_id)
    {
        $alunosTurma = DB::table('matriculas')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->select('alunos.aluno_nome', 'alunos.aluno_id', 'turmas.turma_descricao')
            ->where('matriculas.ativo', 1)
            ->where('turmas.ativo', 1)
            ->where('alunos.ativo', 1)
            ->where('turmas.turma_id', $turma_id)
            ->whereDate('matricula_data_ini', '<=', Carbon::now()->toDateString())
            /*            ->where(
                function ($query) {
                    $query->where('matricula_data_fim', '>', Carbon::now()->toDateString())
                        ->orWhereNull('matricula_data_fim');
                }
            )*/
            ->whereNull('matricula_data_fim')
            ->orderBy('alunos.aluno_nome')
            ->get();

        if (view()->exists('turma.listagemTurmaAluno')) {
            return view('turma.listagemTurmaAluno')->with('alunosTurma', $alunosTurma);
        }
    }


    public function novo()
    {
        $tiposTurma = TipoTurma::where('ativo', 1)->orderBy('tipo_turma_descricao')->get();
        $turnos = Turno::where('ativo', 1)->orderBy('turno_descricao')->get();
        $tipoFrequencia = TipoFrequencia::where('ativo', 1)->orderBy('tipos_frequencia_descricao')->get();

        return view('turma.formularioTurma')
            ->with('tiposTurma', $tiposTurma)
            ->with('turnos', $turnos)
            ->with('tipoFrequencia', $tipoFrequencia);
    }

    public function adiciona(TurmaRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $tipo_turma_id = Request::input('tipo_turma_id');
        $turno_id = Request::input('turno_id');
        $tipo_frequencia_id = Request::input('tipo_frequencia_id');
        $turma_descricao = Request::input('turma_descricao');
        $turma_observacao = Request::input('turma_observacao');

        DB::table('turmas')->insert(
            [
                'tipo_turma_id' => $tipo_turma_id,
                'turno_id' => $turno_id,
                'tipo_frequencia_id' => $tipo_frequencia_id,
                'turma_descricao' => $turma_descricao,
                'turma_observacao' => $turma_observacao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', "Turma adicionada com sucesso");
        return redirect()->action('TurmaController@lista')->withInput(Request::only('turma_descricao'));
    }

    //exclui uma turma
    public function exclui($turma_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $turma = Turma::find($turma_id);
        $turma->ativo = 0;
        $turma->userid_insert = $usuarioLogado;
        $turma->save();
        session()->flash('mensagemSucesso', "Turma excluída com sucesso");
        return redirect()->action('TurmaController@lista');
    }

    public function edita($turma_id)
    {
        $turma = Turma::find($turma_id);
        $tiposTurma = TipoTurma::where('ativo', 1)->orderBy('tipo_turma_descricao')->get();
        $turnos = Turno::where('ativo', 1)->orderBy('turno_descricao')->get();
        $tiposFrequencia = TipoFrequencia::where('ativo', 1)->orderBy('tipos_frequencia_descricao')->get();
        if (empty($turma)) {
            session()->flash('mensagemErro', "Essa turma não existe");
            return redirect()->action('TurmaController@lista');
        }
        return view('turma.editaTurma')->with('t', $turma)
            ->with('tiposTurma', $tiposTurma)
            ->with('turnos', $turnos)
            ->with('tiposFrequencia', $tiposFrequencia);
    }

    public function altera(TurmaRequest $request, $turma_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $turma = Turma::find($turma_id);
        $turma->update($params);
        $turma->userid_insert = $usuarioLogado;
        $turma->save();
        session()->flash('mensagemSucesso', "Turma alterada com sucesso");
        return redirect()->action('TurmaController@lista')->withInput(Request::only('turma_descricao'));
    }
}
