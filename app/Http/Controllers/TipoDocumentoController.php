<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\TipoDocumento;
use junshin\Http\Requests\TipoDocumentoRequest;
use Request;

class TipoDocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $tiposDocumento = TipoDocumento::where('ativo', 1)->get();

        if (view()->exists('dominio.listagemTipoDocumento')) {
            return view('dominio.listagemTipoDocumento')->with('tiposDocumento', $tiposDocumento);
        }
    }

    public function novo()
    {
        return view('dominio.formularioTipoDocumento');
    }

    public function adiciona(TipoDocumentoRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $tipoDocumentoDescricao = Request::input('tipo_documento_descricao');
        DB::table('tipos_documento')->insert(
            [
                'tipo_documento_descricao' => $tipoDocumentoDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', "Tipo de documento adicionado com sucesso");
        return redirect()->action('TipoDocumentoController@lista')->withInput(Request::only('tipo_documento_descricao'));
    }

    //exclui um tipo de documento
    public function exclui($tipo_documento_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $tipo_documento = TipoDocumento::find($tipo_documento_id);
        $tipo_documento->ativo = 0;
        $tipo_documento->userid_insert = $usuarioLogado;
        $tipo_documento->save();
        session()->flash('mensagemSucesso', "Tipo de documento excluído com sucesso");
        return redirect()->action('TipoDocumentoController@lista');
    }

    public function edita($tipo_documento_id)
    {
        $tipo_documento = TipoDocumento::find($tipo_documento_id);

        if (empty($tipo_documento)) {
            session()->flash('mensagemErro', "Esse tipo de documento não existe");
            return redirect()->action('TipoDocumentoController@lista');
        }
        return view('dominio.editaTipoDocumento')->with('t', $tipo_documento);
    }

    public function altera(TipoDocumentoRequest $request, $tipo_documento_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $tipo_documento = TipoDocumento::find($tipo_documento_id);
        $tipo_documento->update($params);
        $tipo_documento->userid_insert = $usuarioLogado;
        $tipo_documento->save();
        session()->flash('mensagemSucesso', "Tipo de documento alterado com sucesso");
        return redirect()->action('TipoDocumentoController@lista')->withInput(Request::only('tipo_documento_descricao'));
    }
}