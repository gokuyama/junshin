<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\TipoTurma;
use junshin\Http\Requests\TipoTurmaRequest;
use Request;

class TipoTurmaController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $tiposTurma = TipoTurma::where('ativo', 1)->get();

        if (view()->exists('dominio.listagemTipoTurma')) {
            return view('dominio.listagemTipoTurma')->with('tiposTurma', $tiposTurma);
        }
    }

    public function novo()
    {
        return view('dominio.formularioTipoTurma');
    }

    public function adiciona(TipoTurmaRequest $request)
    {
        $usuarioLogado = \Auth::user()->name;
        $tipoTurmaDescricao = Request::input('tipo_turma_descricao');
        DB::table('tipos_turma')->insert(
            [
                'tipo_turma_descricao' => $tipoTurmaDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', "Tipo de turma adicionado com sucesso");
        return redirect()->action('TipoTurmaController@lista')->withInput(Request::only('tipo_turma_descricao'));
    }

    //exclui um tipo de turma
    public function exclui($tipo_turma_id)
    {
        $usuarioLogado = \Auth::user()->name;
        $tipo_turma = TipoTurma::find($tipo_turma_id);
        $tipo_turma->ativo = 0;
        $tipo_turma->userid_insert = $usuarioLogado;
        $tipo_turma->save();
        session()->flash('mensagemSucesso', "Tipo de Turma excluído com sucesso");
        return redirect()->action('TipoTurmaController@lista');
    }

    public function edita($tipo_turma_id)
    {
        $tipo_turma = TipoTurma::find($tipo_turma_id);

        if (empty($tipo_turma)) {
            session()->flash('mensagemErro', "Essa tipo de turma não existe");
            return redirect()->action('TipoTurmaController@lista');
        }
        return view('dominio.editaTipoTurma')->with('t', $tipo_turma);
    }

    public function altera(TipoTurmaRequest $request, $tipo_turma_id)
    {
        $usuarioLogado = \Auth::user()->name;
        $params = Request::all();
        $tipo_turma = TipoTurma::find($tipo_turma_id);
        $tipo_turma->update($params);
        $tipo_turma->userid_insert = $usuarioLogado;
        $tipo_turma->save();
        session()->flash('mensagemSucesso', "Tipo de turma alterado com sucesso");
        return redirect()->action('TipoTurmaController@lista')->withInput(Request::only('tipo_turma_descricao'));
    }
}