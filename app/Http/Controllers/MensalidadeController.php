<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\MensalidadeRequest;
use junshin\Mensalidade;
use junshin\Turma;
use Request;
use Carbon\Carbon;

class MensalidadeController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function novo($matricula_id)
    {
        return view('mensalidade.formularioMensalidade')->with('matricula_id', $matricula_id);
    }

    public function adiciona(MensalidadeRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $mensalidade_valor = Request::input('mensalidade_valor');
        $mensalidade_data_ini = Request::input('mensalidade_data_ini');
        $mensalidade_dt_ini = str_replace('/', '-', $mensalidade_data_ini);
        if ($mensalidade_dt_ini != null) {
            $mensalidade_dt_ini = date("Y-m-d", strtotime($mensalidade_dt_ini));
        } else {
            $mensalidade_dt_ini = null;
        }
        $matricula_id = Request::input('matricula_id');
        $ultimoDiaAno = Carbon::createFromDate(null, 12, 31)->startOfDay();

        //pega a mensalidade anterior
        $mensalidadeAnterior = Mensalidade::where('ativo', 1)
            ->where('matricula_id', $matricula_id)
            ->orderBy('mensalidade_id', 'desc')
            ->get();

        $listaMensalidades = Mensalidade::where('matricula_id', $matricula_id)->orderBy('mensalidade_data_ini', 'desc')->get();

        $listagemMatriculas = DB::table('matriculas')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->select('matriculas.matricula_id', 'matriculas.matricula_data_ini', 'matriculas.matricula_data_fim', 'turmas.turma_id', 'turmas.turma_descricao', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('matriculas.matricula_id', $matricula_id)
            ->orderBy('matriculas.matricula_id', 'desc')
            ->first();

        $turmas = Turma::where('ativo', 1)->orderBy('turma_descricao')->get();

        if (count($mensalidadeAnterior) > 0) {
            if ($mensalidadeAnterior[0]->mensalidade_data_ini >= $mensalidade_dt_ini) {
                session()->flash('mensagemErro', "Data Início menor que a Data Início anterior");
                return view('matricula.editaMatricula')
                    ->with('listagemMatriculas', $listagemMatriculas)
                    ->with('turmas', $turmas)
                    ->with('listaMensalidades', $listaMensalidades);
            }
            $mensalidadeAnterior[0]->mensalidade_data_fim = Carbon::createFromFormat('d/m/Y', $mensalidade_data_ini, 'America/Sao_Paulo')->subdays(1);
            $mensalidadeAnterior[0]->userid_insert = $usuarioLogado;
            $mensalidadeAnterior[0]->save();
        }

        //cadastra a mensalidade
        DB::table('mensalidades')->insert(
            [
                'matricula_id' => $matricula_id,
                'mensalidade_data_ini' => $mensalidade_dt_ini,
                'mensalidade_data_fim' => $ultimoDiaAno,
                'mensalidade_valor' => str_replace(",", ".", str_replace(".", "", $mensalidade_valor)),
                'userid_insert' => $usuarioLogado
            ]
        );

        $listaMensalidades = Mensalidade::where('matricula_id', $matricula_id)->orderBy('mensalidade_data_ini', 'desc')->get();

        if (empty($listagemMatriculas)) {
            return "Essa matrícula não existe";
        }
        session()->flash('mensagemSucesso', "Mensalidade cadastrada com sucesso");
        return view('matricula.editaMatricula')
            ->with('listagemMatriculas', $listagemMatriculas)
            ->with('turmas', $turmas)
            ->with('listaMensalidades', $listaMensalidades);
    }
}