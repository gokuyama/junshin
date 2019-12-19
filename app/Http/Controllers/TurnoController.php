<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Turno;
use junshin\Http\Requests\TurnoRequest;
use Request;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $turno = Turno::where('ativo', 1)->get();

        if (view()->exists('dominio.listagemTurno')) {
            return view('dominio.listagemTurno')->with('turnos', $turno);
        }
    }

    public function novo()
    {
        return view('dominio.formularioTurno');
    }

    public function adiciona(TurnoRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $turnoDescricao = Request::input('turno_descricao');
        DB::table('turnos')->insert(
            [
                'turno_descricao' => $turnoDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', "Turno adicionado com sucesso");
        return redirect()->action('TurnoController@lista')->withInput(Request::only('turno_descricao'));
    }

    //exclui um turno
    public function exclui($turno_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $turno = Turno::find($turno_id);
        $turno->ativo = 0;
        $turno->userid_insert = $usuarioLogado;
        $turno->save();
        session()->flash('mensagemSucesso', "Turno excluído com sucesso");
        return redirect()->action('TurnoController@lista');
    }

    public function edita($turno_id)
    {
        $turno = Turno::find($turno_id);

        if (empty($turno)) {
            session()->flash('mensagemErro', "Esse turno não existe");
            return redirect()->action('TurnoController@lista');
        }
        return view('dominio.editaTurno')->with('t', $turno);
    }

    public function altera(TurnoRequest $request, $turno_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $turno = Turno::find($turno_id);
        $turno->update($params);
        $turno->userid_insert = $usuarioLogado;
        $turno->save();
        session()->flash('mensagemSucesso', "Turno alterado com sucesso");
        return redirect()->action('TurnoController@lista')->withInput(Request::only('turno_descricao'));
    }
}