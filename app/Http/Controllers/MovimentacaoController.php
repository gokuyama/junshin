<?php namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Movimentacao;
use junshin\TipoMovimentacao;
use junshin\Http\Requests\MovimentacaoRequest;
use Request;

class MovimentacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }
    
    public function listaEntradas()
    {

        $movimentacao = DB::table('movimentacoes')
        ->join('tipos_movimentacao','tipos_movimentacao.tipo_movimentacao_id','=','movimentacoes.tipo_movimentacao_id')
        ->select('movimentacoes.movimentacao_id','movimentacoes.movimentacao_data','movimentacoes.movimentacao_valor','movimentacoes.movimentacao_observacao','tipos_movimentacao.tipo_movimentacao','tipos_movimentacao.tipo_movimentacao_descricao')
        ->where('tipos_movimentacao.tipo_movimentacao',1)
        ->where('movimentacoes.ativo',1)
        ->where('tipos_movimentacao.ativo',1)
        ->orderBy('movimentacoes.movimentacao_data')
        ->paginate(10);

        if (view()->exists('movimentacao.listagemMovimentacaoEntradas')) {
            return view('movimentacao.listagemMovimentacaoEntradas')->with('movimentacao', $movimentacao);
        }

    }

    public function listaSaidas()
    {

        $movimentacao = DB::table('movimentacoes')
        ->join('tipos_movimentacao','tipos_movimentacao.tipo_movimentacao_id','=','movimentacoes.tipo_movimentacao_id')
        ->select('movimentacoes.movimentacao_id','movimentacoes.movimentacao_data','movimentacoes.movimentacao_valor','movimentacoes.movimentacao_observacao','tipos_movimentacao.tipo_movimentacao','tipos_movimentacao.tipo_movimentacao_descricao')
        ->where('tipos_movimentacao.tipo_movimentacao',0)
        ->where('movimentacoes.ativo',1)
        ->where('tipos_movimentacao.ativo',1)
        ->orderBy('movimentacoes.movimentacao_data')
        ->paginate(10);

        if (view()->exists('movimentacao.listagemMovimentacaoSaidas')) {
            return view('movimentacao.listagemMovimentacaoSaidas')->with('movimentacao', $movimentacao);
        }

    }

    public function novaEntrada()
    {
        $tiposMovimentacao = TipoMovimentacao::where('ativo',1)->where('tipo_movimentacao',1)->orderBy('tipo_movimentacao_descricao')->get();

        return view('movimentacao.formularioMovimentacaoEntrada')->with('tiposMovimentacao',$tiposMovimentacao);
    }

    public function novaSaida()
    {
        $tiposMovimentacao = TipoMovimentacao::where('ativo',1)->where('tipo_movimentacao',0)->orderBy('tipo_movimentacao_descricao')->get();

        return view('movimentacao.formularioMovimentacaoSaida')->with('tiposMovimentacao',$tiposMovimentacao);
    }

    public function adicionaEntrada(MovimentacaoRequest $request)
    {
        $usuarioLogado=\Auth::user()->name;
        $movimentacao = Request::input('tipo_movimentacao_id');
        $movimentacaoData = Request::input('movimentacao_data');
        $dt_nascimento = str_replace('/', '-', $movimentacaoData );
        $data_nascimento = date("Y-m-d", strtotime($dt_nascimento));
        $movimentacaoValor = Request::input('movimentacao_valor');
        $movimentacaoObservacao = Request::input('movimentacao_observacao');
        DB::table('movimentacoes')->insert(
            [
                'tipo_movimentacao_id' => $movimentacao,
                'movimentacao_data' => $data_nascimento,
                'movimentacao_valor' => $movimentacaoValor,
                'movimentacao_observacao' => $movimentacaoObservacao,
                'userid_insert' => $usuarioLogado
            ]
        );
        return redirect()->action('MovimentacaoController@listaEntradas')->withInput(Request::only('movimentacao_observacao'));
    }

    public function adicionaSaida(MovimentacaoRequest $request)
    {
        $usuarioLogado=\Auth::user()->name;
        $movimentacao = Request::input('tipo_movimentacao_id');
        $movimentacaoData = Request::input('movimentacao_data');
        $dt_nascimento = str_replace('/', '-', $movimentacaoData );
        $data_nascimento = date("Y-m-d", strtotime($dt_nascimento));
        $movimentacaoValor = Request::input('movimentacao_valor');
        $movimentacaoObservacao = Request::input('movimentacao_observacao');
        DB::table('movimentacoes')->insert(
            [
                'tipo_movimentacao_id' => $movimentacao,
                'movimentacao_data' => $data_nascimento,
                'movimentacao_valor' => $movimentacaoValor,
                'movimentacao_observacao' => $movimentacaoObservacao,
                'userid_insert' => $usuarioLogado
            ]
        );
        return redirect()->action('MovimentacaoController@listaSaidas')->withInput(Request::only('movimentacao_observacao'));
    }

    //exclui entrada
	public function excluiEntrada($movimentacao_id)
	{
        $usuarioLogado=\Auth::user()->name;
		$movimentacao = Movimentacao::find($movimentacao_id);
        $movimentacao->ativo = 0;
        $movimentacao->userid_insert=$usuarioLogado;
        $movimentacao->save();
		return redirect()->action('MovimentacaoController@listaEntradas');
	}

    //exclui saida
	public function excluiSaida($movimentacao_id)
	{
        $usuarioLogado=\Auth::user()->name;
		$movimentacao = Movimentacao::find($movimentacao_id);
        $movimentacao->ativo = 0;
        $movimentacao->userid_insert=$usuarioLogado;
        $movimentacao->save();
		return redirect()->action('MovimentacaoController@listaSaidas');
	}

    public function editaEntrada($movimentacao_id)
	{
		$movimentacao = Movimentacao::find($movimentacao_id);
        $tiposMovimentacao = TipoMovimentacao::where('ativo',1)->where('tipo_movimentacao',1)->orderBy('tipo_movimentacao_descricao')->get();

		if (empty($movimentacao)) {
			return "Esse tipo não existe";
		}
        return view('movimentacao.editaMovimentacaoEntrada')->with('t', $movimentacao)->with('tiposMovimentacao',$tiposMovimentacao);

	}

    public function editaSaida($movimentacao_id)
	{
		$movimentacao = Movimentacao::find($movimentacao_id);
        $tiposMovimentacao = TipoMovimentacao::where('ativo',1)->where('tipo_movimentacao',0)->orderBy('tipo_movimentacao_descricao')->get();

		if (empty($movimentacao)) {
			return "Esse tipo não existe";
		}
        return view('movimentacao.editaMovimentacaoSaida')->with('t', $movimentacao)->with('tiposMovimentacao',$tiposMovimentacao);

	}

    public function alteraEntrada(MovimentacaoRequest $request,$movimentacao_id)
	{
        $usuarioLogado=\Auth::user()->name;
		$params = Request::all();
        $movimentacao = Movimentacao::find($movimentacao_id);
        $movimentacao->update($params);
        $movimentacao->userid_insert=$usuarioLogado;
        $movimentacao->save();
		return redirect()->action('MovimentacaoController@listaEntradas')->withInput(Request::only('movimentacao_observacao'));
    }

    public function alteraSaida(MovimentacaoRequest $request,$movimentacao_id)
	{
        $usuarioLogado=\Auth::user()->name;
		$params = Request::all();
        $movimentacao = Movimentacao::find($movimentacao_id);
        $movimentacao->update($params);
        $movimentacao->userid_insert=$usuarioLogado;
        $movimentacao->save();
		return redirect()->action('MovimentacaoController@listaSaidas')->withInput(Request::only('movimentacao_observacao'));
    }

    public function relatorioMovimentacao()
    {
        $movimentacao = DB::table('movimentacoes')
        ->join('tipos_movimentacao','tipos_movimentacao.tipo_movimentacao_id','=','movimentacoes.tipo_movimentacao_id')
        ->select('movimentacoes.movimentacao_id','movimentacoes.movimentacao_data','movimentacoes.movimentacao_valor','movimentacoes.movimentacao_observacao','tipos_movimentacao.tipo_movimentacao','tipos_movimentacao.tipo_movimentacao_descricao')
        ->where('movimentacoes.ativo',1)
        ->where('tipos_movimentacao.ativo',1)
        ->orderBy('movimentacoes.movimentacao_data')
        ->get();

        $data = [
            'movimentacao' => $movimentacao
        ];

        return \PDF::loadView('movimentacao.relatorioMovimentacao', $data)
                    // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                    ->download('movimentacoes.pdf');

    }

}
