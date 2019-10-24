<?php namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\TipoResponsavel;
use junshin\Http\Requests\TipoResponsavelRequest;
use Request;

class TipoResponsavelController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }
    
    public function lista()
    {
        $tiposResponsavel = TipoResponsavel::where('ativo',1)->get();

        if (view()->exists('dominio.listagemTipoResponsavel')) {
            return view('dominio.listagemTipoResponsavel')->with('tiposResponsavel', $tiposResponsavel);
        }
    }

    public function novo()
    {
        return view('dominio.formularioTipoResponsavel');
    }

    public function adiciona(TipoResponsavelRequest $request)
    {
        $usuarioLogado=\Auth::user()->username;
        $TipoResponsavelDescricao = Request::input('tipo_responsavel_descricao');
        DB::table('tipos_responsavel')->insert(
            [
                'tipo_responsavel_descricao' => $TipoResponsavelDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        return redirect()->action('TipoResponsavelController@lista')->withInput(Request::only('tipo_responsavel_descricao'));
    }

    //exclui um tipo de responsável
	public function exclui($tipo_responsavel_id)
	{
        $usuarioLogado=\Auth::user()->username;
		$tipo_responsavel = TipoResponsavel::find($tipo_responsavel_id);
        $tipo_responsavel->ativo = 0;
        $tipo_responsavel->userid_insert=$usuarioLogado;
        $tipo_responsavel->save();
		return redirect()->action('TipoResponsavelController@lista');
	}

    public function edita($tipo_responsavel_id)
	{
		$tipo_responsavel = TipoResponsavel::find($tipo_responsavel_id);

		if (empty($tipo_responsavel)) {
			return "Esse tipo de responsável não existe";
		}
        return view('dominio.editaTipoResponsavel')->with('t', $tipo_responsavel);

	}

    public function altera(TipoResponsavelRequest $request,$tipo_responsavel_id)
	{
        $usuarioLogado=\Auth::user()->username;
		$params = Request::all();
        $tipo_responsavel = TipoResponsavel::find($tipo_responsavel_id);
        $tipo_responsavel->update($params);
        $tipo_responsavel->userid_insert=$usuarioLogado;
        $tipo_responsavel->save();
		return redirect()->action('TipoResponsavelController@lista')->withInput(Request::only('tipo_responsavel_descricao'));
	}
}
