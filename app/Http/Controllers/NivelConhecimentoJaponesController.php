<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\NivelConhecimentoJapones;
use junshin\Http\Requests\NivelConhecimentoJaponesRequest;
use Request;

class NivelConhecimentoJaponesController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $niveisConhecimentoJapones = NivelConhecimentoJapones::where('ativo', 1)->get();

        if (view()->exists('dominio.listagemNivelConhecimentoJapones')) {
            return view('dominio.listagemNivelConhecimentoJapones')->with('niveisConhecimentoJapones', $niveisConhecimentoJapones);
        }
    }

    public function novo()
    {
        return view('dominio.formularioNivelConhecimentoJapones');
    }

    public function adiciona(NivelConhecimentoJaponesRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $NivelConhecimentoJaponesDescricao = Request::input('nivel_conhecimento_japones_descricao');
        DB::table('niveis_conhecimento_japones')->insert(
            [
                'nivel_conhecimento_japones_descricao' => $NivelConhecimentoJaponesDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', "Nível de conhecimento de japonês adicionado com sucesso");
        return redirect()->action('NivelConhecimentoJaponesController@lista')->withInput(Request::only('nivel_conhecimento_japones_descricao'));
    }

    //exclui um nivel_conhecimento_japones
    public function exclui($nivel_conhecimento_japones_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $nivel_conhecimento_japones = NivelConhecimentoJapones::find($nivel_conhecimento_japones_id);
        $nivel_conhecimento_japones->ativo = 0;
        $nivel_conhecimento_japones->userid_insert = $usuarioLogado;
        $nivel_conhecimento_japones->save();
        session()->flash('mensagemSucesso', "Nível de conhecimento de japonês excluído com sucesso");
        return redirect()->action('NivelConhecimentoJaponesController@lista');
    }

    public function edita($nivel_conhecimento_japones_id)
    {
        $nivel_conhecimento_japones = NivelConhecimentoJapones::find($nivel_conhecimento_japones_id);

        if (empty($nivel_conhecimento_japones)) {
            session()->flash('mensagemErro', "Essa nível de conhecimento de japonês não existe");
            return redirect()->action('NivelConhecimentoJaponesController@lista');
        }
        return view('dominio.editaNivelConhecimentoJapones')->with('n', $nivel_conhecimento_japones);
    }

    public function altera(NivelConhecimentoJaponesRequest $request, $nivel_conhecimento_japones_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $nivel_conhecimento_japones = NivelConhecimentoJapones::find($nivel_conhecimento_japones_id);
        $nivel_conhecimento_japones->update($params);
        $nivel_conhecimento_japones->userid_insert = $usuarioLogado;
        $nivel_conhecimento_japones->save();
        session()->flash('mensagemSucesso', "Nível de conhecimento de japonês alterado com sucesso");
        return redirect()->action('NivelConhecimentoJaponesController@lista')->withInput(Request::only('nivel_conhecimento_japones_descricao'));
    }
}