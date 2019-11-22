<?php namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\TipoMovimentacao;
use junshin\Http\Requests\TipoMovimentacaoRequest;
use Request;

class TipoMovimentacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }
    
    public function lista()
    {
        $tipoMovimentacao = TipoMovimentacao::where('ativo',1)->orderBy('tipo_movimentacao')->get();

        if (view()->exists('dominio.listagemTipoMovimentacao')) {
            return view('dominio.listagemTipoMovimentacao')->with('tipoMovimentacao', $tipoMovimentacao);
        }
    }

    public function novo()
    {
        return view('dominio.formularioTipoMovimentacao');
    }

    public function adiciona(TipoMovimentacaoRequest $request)
    {
        $usuarioLogado=\Auth::user()->name;
        $tipoMovimentacao = Request::input('tipo_movimentacao');
        $tipoMovimentacaoDescricao = Request::input('tipo_movimentacao_descricao');
        DB::table('tipos_movimentacao')->insert(
            [
                'tipo_movimentacao' => $tipoMovimentacao,
                'tipo_movimentacao_descricao' => $tipoMovimentacaoDescricao,
                'userid_insert' => $usuarioLogado
            ]
        );
        return redirect()->action('TipoMovimentacaoController@lista')->withInput(Request::only('tipo_movimentacao_descricao'));
    }

    //exclui um turno
	public function exclui($tipo_movimentacao_id)
	{
        $usuarioLogado=\Auth::user()->name;
		$tipoMovimentacao = TipoMovimentacao::find($tipo_movimentacao_id);
        $tipoMovimentacao->ativo = 0;
        $tipoMovimentacao->userid_insert=$usuarioLogado;
        $tipoMovimentacao->save();
		return redirect()->action('TipoMovimentacaoController@lista');
	}

    public function edita($tipo_movimentacao_id)
	{
		$tipoMovimentacao = TipoMovimentacao::find($tipo_movimentacao_id);

		if (empty($tipoMovimentacao)) {
			return "Esse tipo não existe";
		}
        return view('dominio.editaTipoMovimentacao')->with('t', $tipoMovimentacao);

	}

    public function altera(TipoMovimentacaoRequest $request,$tipo_movimentacao_id)
	{
        $usuarioLogado=\Auth::user()->name;
		$params = Request::all();
        $tipoMovimentacao = TipoMovimentacao::find($tipo_movimentacao_id);
        $tipoMovimentacao->update($params);
        $tipoMovimentacao->userid_insert=$usuarioLogado;
        $tipoMovimentacao->save();
		return redirect()->action('TipoMovimentacaoController@lista')->withInput(Request::only('tipo_movimentacao_descricao'));
	}
}
