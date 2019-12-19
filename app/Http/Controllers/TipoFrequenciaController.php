<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\TipoFrequencia;
use junshin\Http\Requests\TipoFrequenciaRequest;
use Request;

class TipoFrequenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $tiposFrequencia = TipoFrequencia::where('ativo', 1)->get();

        if (view()->exists('dominio.listagemTipoFrequencia')) {
            return view('dominio.listagemTipoFrequencia')->with('tiposFrequencia', $tiposFrequencia);
        }
    }

    public function novo()
    {
        return view('dominio.formularioTipoFrequencia');
    }

    public function adiciona(TipoFrequenciaRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $TipoFrequenciaDescricao = Request::input('tipos_frequencia_descricao');
        DB::table('tipos_frequencia')->insert(
            [
                'tipos_frequencia_descricao' => $TipoFrequenciaDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', "Tipo de frequência adicionado com sucesso");
        return redirect()->action('TipoFrequenciaController@lista')->withInput(Request::only('tipos_frequencia_descricao'));
    }

    //exclui um tipo de frequência
    public function exclui($tipo_frequencia_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $tipo_frequencia = TipoFrequencia::find($tipo_frequencia_id);
        $tipo_frequencia->ativo = 0;
        $tipo_frequencia->userid_insert = $usuarioLogado;
        $tipo_frequencia->save();
        session()->flash('mensagemSucesso', "Tipo de frequência excluído com sucesso");
        return redirect()->action('TipoFrequenciaController@lista');
    }

    public function edita($tipo_frequencia_id)
    {
        $tipo_frequencia = TipoFrequencia::find($tipo_frequencia_id);

        if (empty($tipo_frequencia)) {
            session()->flash('mensagemErro', "Essa tipo de frequência não existe");
            return redirect()->action('TipoFrequenciaController@lista');
        }
        return view('dominio.editaTipoFrequencia')->with('t', $tipo_frequencia);
    }

    public function altera(TipoFrequenciaRequest $request, $tipo_frequencia_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $tipo_frequencia = TipoFrequencia::find($tipo_frequencia_id);
        $tipo_frequencia->update($params);
        $tipo_frequencia->userid_insert = $usuarioLogado;
        $tipo_frequencia->save();
        session()->flash('mensagemSucesso', "Tipo de frequência alterado com sucesso");
        return redirect()->action('TipoFrequenciaController@lista')->withInput(Request::only('tipos_frequencia_descricao'));
    }
}