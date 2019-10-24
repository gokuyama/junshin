<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\HistoricoRequest;
use junshin\Http\Requests\LocalizaHistoricoRequest;
use junshin\Historico;
use junshin\Aluno;
use Request;
use Carbon\Carbon;

class HistoricoController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $listaHistoricos = null;
        if (view()->exists('historico.listagemHistorico')) {
            return view('historico.listagemHistorico')->with('listaHistoricos', $listaHistoricos);
        }
    }

    public function localizaHistoricoPorAluno($aluno_id)
    {
        $listaHistoricos = DB::table('historico_instituicoes')
            ->join('alunos', 'alunos.aluno_id', '=', 'historico_instituicoes.aluno_id')
            ->select('historico_instituicoes.historico_instituicao_id', 'historico_instituicoes.historico_instituicao_nome', 'historico_instituicoes.historico_instituicao_ano', 'historico_instituicoes.historico_instituicao_serie', 'alunos.aluno_nome')
            ->where('historico_instituicoes.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->orderBy('historico_instituicoes.historico_instituicao_ano')
            ->get();

        if (view()->exists('historico.listagemHistorico')) {
            return view('historico.listagemHistorico')
                ->with('listaHistoricos', $listaHistoricos)
                ->with('aluno_id', $aluno_id);
        }
    }

    public function novo()
    {
        return view('historico.formularioHistorico');
    }

    public function novoHistoricoPorAluno($aluno_id)
    {
        $alunos = Aluno::where('ativo', 1)->where('aluno_id', $aluno_id)->get();

        return view('historico.formularioHistorico')
            ->with('alunos', $alunos);
    }

    public function adiciona(HistoricoRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $aluno_id = Request::input('aluno_id');
        $historico_instituicao_nome = Request::input('historico_instituicao_nome');
        $historico_instituicao_ano = Request::input('historico_instituicao_ano');
        $historico_instituicao_serie = Request::input('historico_instituicao_serie');

        $historico_instituicao_id = DB::table('historico_instituicoes')->insertGetId(
            [
                'aluno_id' => $aluno_id,
                'historico_instituicao_nome' => $historico_instituicao_nome,
                'historico_instituicao_ano' => $historico_instituicao_ano,
                'historico_instituicao_serie' => $historico_instituicao_serie,
                'userid_insert' => $usuarioLogado
            ]
        );

        return  $this->localizaHistoricoPorAluno($aluno_id);
    }

    //exclui um Histórico
    public function exclui($historico_instituicao_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $historico = Historico::find($historico_instituicao_id);
        $historico->ativo = 0;
        $historico->userid_insert = $usuarioLogado;
        $historico->save();
        $listaHistoricos = null;

        return  $this->localizaHistoricoPorAluno($historico->aluno_id);
    }

    public function edita($historico_instituicao_id)
    {
        $historico = Historico::find($historico_instituicao_id);
        $alunos = Aluno::where('ativo', 1)->orderBy('aluno_nome')->get();
        if (empty($historico)) {
            return "Esse Histórico não existe";
        }
        return view('historico.editaHistorico')
            ->with('h', $historico)
            ->with('alunos', $alunos);
    }

    public function altera(HistoricoRequest $request, $historico_instituicao_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $historico = Historico::find($historico_instituicao_id);
        $historico->update($params);
        $historico->userid_insert = $usuarioLogado;
        $historico->save();

        return  $this->localizaHistoricoPorAluno($params['aluno_id']);
    }
}