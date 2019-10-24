<?php namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\NivelEscolaridade;
use junshin\Http\Requests\NivelEscolaridadeRequest;
use Request;

class NivelEscolaridadeController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }
    
    public function lista()
    {
        $niveisEscolaridade = NivelEscolaridade::where('ativo',1)->get();

        if (view()->exists('dominio.listagemNivelEscolaridade')) {
            return view('dominio.listagemNivelEscolaridade')->with('niveisEscolaridade', $niveisEscolaridade);
        }
    }

    public function novo()
    {
        return view('dominio.formularioNivelEscolaridade');
    }

    public function adiciona(NivelEscolaridadeRequest $request)
    {
        $usuarioLogado=\Auth::user()->username;
        $NivelEscolaridadeDescricao = Request::input('nivel_escolaridade_descricao');
        DB::table('niveis_escolaridade')->insert(
            [
                'nivel_escolaridade_descricao' => $NivelEscolaridadeDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        return redirect()->action('NivelEscolaridadeController@lista')->withInput(Request::only('nivel_escolaridade_descricao'));
    }

    //exclui um nivel_escolaridade
	public function exclui($nivel_escolaridade_id)
	{
        $usuarioLogado=\Auth::user()->username;
		$nivel_escolaridade = NivelEscolaridade::find($nivel_escolaridade_id);
        $nivel_escolaridade->ativo = 0;
        $nivel_escolaridade->userid_insert=$usuarioLogado;
        $nivel_escolaridade->save();
		return redirect()->action('NivelEscolaridadeController@lista');
	}

    public function edita($nivel_escolaridade_id)
	{
		$nivel_escolaridade = NivelEscolaridade::find($nivel_escolaridade_id);

		if (empty($nivel_escolaridade)) {
			return "Esse nível de escolaridade não existe";
		}
        return view('dominio.editaNivelEscolaridade')->with('n', $nivel_escolaridade);

	}

    public function altera(NivelEscolaridadeRequest $request,$nivel_escolaridade_id)
	{
        $usuarioLogado=\Auth::user()->username;
		$params = Request::all();
        $nivel_escolaridade = NivelEscolaridade::find($nivel_escolaridade_id);
        $nivel_escolaridade->update($params);
        $nivel_escolaridade->userid_insert=$usuarioLogado;
        $nivel_escolaridade->save();
		return redirect()->action('NivelEscolaridadeController@lista')->withInput(Request::only('nivel_escolaridade_descricao'));
	}
}
