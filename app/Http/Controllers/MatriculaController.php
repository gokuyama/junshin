<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\MatriculaRequest;
use junshin\Http\Requests\LocalizaMatriculaRequest;
use junshin\Matricula;
use junshin\Mensalidade;
use junshin\Turma;
use junshin\Aluno;
use Request;
use Carbon\Carbon;
use DateTimeZone;

class MatriculaController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function localizaMatriculaPorAluno($aluno_id)
    {
        $listagemMatriculas = DB::table('matriculas')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->select('matriculas.matricula_id', 'matriculas.matricula_data_ini', 'matriculas.matricula_data_fim', 'turmas.turma_descricao', 'alunos.aluno_nome')
            ->where('matriculas.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->orderBy('matriculas.matricula_id', 'desc')
            ->get();

        if (view()->exists('matricula.listagemMatricula')) {
            return view('matricula.listagemMatricula')
                ->with('listagemMatriculas', $listagemMatriculas)
                ->with('aluno_id', $aluno_id);
        }
    }

    public function novo()
    {
        $turmas = Turma::where('ativo', 1)->orderBy('turma_descricao')->get();
        $alunos = Aluno::where('ativo', 1)->orderBy('aluno_nome')->get();

        return view('matricula.formularioMatricula')
            ->with('alunos', $alunos)
            ->with('turmas', $turmas);
    }

    public function novaMatriculaPorAluno($aluno_id)
    {
        $turmas = Turma::where('ativo', 1)->orderBy('turma_descricao')->get();
        $alunos = Aluno::where('ativo', 1)->where('aluno_id', $aluno_id)->get();

        return view('matricula.formularioMatricula')
            ->with('alunos', $alunos)
            ->with('turmas', $turmas);
    }

    public function adiciona(MatriculaRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $turma_id = Request::input('turma_id');
        $aluno_id = Request::input('aluno_id');
        $mensalidade_valor = Request::input('mensalidade_valor');
        $matricula_data_ini = Request::input('matricula_data_ini');
        $matricula_dt_ini = str_replace('/', '-', $matricula_data_ini);
        if ($matricula_dt_ini != null) {
            $matricula_dt_ini = date("Y-m-d", strtotime($matricula_dt_ini));
        } else {
            $matricula_dt_ini = null;
        }
        //pega a matrícula anterior
        $matriculaAnterior = Matricula::where('ativo', 1)
            ->where('aluno_id', $aluno_id)
            ->orderBy('matricula_id', 'desc')
            ->get();

        if (count($matriculaAnterior) > 0) {
            $matriculaAnterior[0]->matricula_data_fim = Carbon::createFromFormat('d/m/Y', $matricula_data_ini, 'America/Sao_Paulo')->subdays(1);
            $matriculaAnterior[0]->userid_insert = $usuarioLogado;
            $matriculaAnterior[0]->save();
        }

        $ultimoDiaAno = Carbon::createFromDate(null, 12, 31)->startOfDay();

        $matricula_id = DB::table('matriculas')->insertGetId(
            [
                'turma_id' => $turma_id,
                'aluno_id' => $aluno_id,
                'matricula_data_ini' => $matricula_dt_ini,
                'matricula_data_fim' => $ultimoDiaAno,
                'userid_insert' => $usuarioLogado
            ]
        );

        //cadastra a mensalidade
        $mensalidade_id = DB::table('mensalidades')->insertGetId(
            [
                'matricula_id' => $matricula_id,
                'mensalidade_data_ini' => Carbon::now(new DateTimeZone('America/Sao_Paulo'))->toDateTimeString(),
                'mensalidade_data_fim' => $ultimoDiaAno,
                'mensalidade_valor' => str_replace(",", ".", str_replace(".", "", $mensalidade_valor)),
                'userid_insert' => $usuarioLogado
            ]
        );

        return $this->localizaMatriculaPorAluno($aluno_id);
    }


    //exclui uma Matrícula
    public function exclui($matricula_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $matricula = Matricula::find($matricula_id);
        $matricula->ativo = 0;
        $matricula->userid_insert = $usuarioLogado;
        $matricula->save();

        return $this->localizaMatriculaPorAluno($matricula['aluno_id']);
    }

    public function edita($matricula_id)
    {
        $ultimoDiaAno = Carbon::createFromDate(null, 12, 31)->startOfDay();

        $listagemMatriculas = DB::table('matriculas')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->select('matriculas.matricula_id', 'matriculas.matricula_data_ini', 'matriculas.matricula_data_fim', 'turmas.turma_id', 'turmas.turma_descricao', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('matriculas.matricula_id', $matricula_id)
            ->orderBy('matriculas.matricula_id', 'desc')
            ->first();

        $turmas = Turma::where('ativo', 1)->orderBy('turma_descricao')->get();

        $mensalidade = Mensalidade::where('matricula_id', $matricula_id)->where('mensalidade_data_fim', $ultimoDiaAno)->first();

        if (empty($listagemMatriculas)) {
            return "Essa matrícula não existe";
        }
        return view('matricula.editaMatricula')
            ->with('listagemMatriculas', $listagemMatriculas)
            ->with('turmas', $turmas)
            ->with('mensalidade', $mensalidade);
    }

    public function altera(MatriculaRequest $request, $matricula_id)
    {
        $ultimoDiaAno = Carbon::createFromDate(null, 12, 31)->startOfDay();
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $matricula = Matricula::find($matricula_id);
        $matricula_data_ini = $params['matricula_data_ini'];
        $matricula_data_fim = $params['matricula_data_fim'];
        $matricula_dt_ini = str_replace('/', '-', $matricula_data_ini);
        if ($matricula_dt_ini != null) {
            $matricula_dt_ini = date("Y-m-d", strtotime($matricula_dt_ini));
        } else {
            $matricula_dt_ini = null;
        }
        $matricula_dt_fim = str_replace('/', '-', $matricula_data_fim);
        if ($matricula_dt_fim != null) {
            $matricula_dt_fim = date("Y-m-d", strtotime($matricula_dt_fim));
        } else {
            $matricula_dt_fim = null;
        }
        $params['matricula_data_ini'] = $matricula_dt_ini;
        $params['matricula_data_fim'] = $matricula_dt_fim;
        $matricula->update($params);
        $matricula->userid_insert = $usuarioLogado;
        $matricula->save();

        $mensalidadeValorNova = $params['mensalidade_valor'];
        $mensalidadeOld = Mensalidade::where('matricula_id', '=', $matricula_id)->where('mensalidade_data_fim', $ultimoDiaAno)->first();

        if ($mensalidadeValorNova != $mensalidadeOld->mensalidade_valor) {
            $mensalidadeOld->mensalidade_data_fim = Carbon::now(new DateTimeZone('America/Sao_Paulo'))->toDateTimeString();
            $mensalidadeOld->save();

            DB::table('mensalidades')->insert(
                [
                    'matricula_id' =>  $matricula_id,
                    'mensalidade_data_ini' => Carbon::now(new DateTimeZone('America/Sao_Paulo'))->toDateTimeString(),
                    'mensalidade_valor' => str_replace(",", ".", str_replace(".", "", $mensalidadeValorNova)),
                    'mensalidade_data_fim' => $ultimoDiaAno,
                    'userid_insert' => $usuarioLogado
                ]
            );
        }

        return $this->localizaMatriculaPorAluno($params['aluno_id']);
    }
}