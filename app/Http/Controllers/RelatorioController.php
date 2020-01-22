<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Turma;
use junshin\Aluno;
use PDF;
use Carbon\Carbon;
use DateTimeZone;

class RelatorioController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function listaPorAluno($aluno_id)
    {
        $aluno = Aluno::find($aluno_id);

        if (view()->exists('relatorio.listagemRelatoriosAlunos')) {
            return view('relatorio.listagemRelatoriosAlunos')
                ->with('aluno', $aluno);
        }
    }

    public function listaPorTurma($turma_id)
    {
        $turma = Turma::find($turma_id);

        if (view()->exists('relatorio.listagemRelatoriosTurma')) {
            return view('relatorio.listagemRelatoriosTurma')
                ->with('turma', $turma);
        }
    }

    public function declaracaoMatricula($aluno_id)
    {
        $dados = DB::table('matriculas')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->select('matriculas.matricula_data_ini', 'matriculas.matricula_data_fim', 'turmas.turma_descricao', 'alunos.aluno_nome')
            ->where('matriculas.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->whereDate('matriculas.matricula_data_ini', '<=', Carbon::now()->toDateString())
            ->whereNull('matriculas.matricula_data_fim')
            ->get();

        $responsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->get();

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data_hoje = strftime('%d de %B de %Y', strtotime('today'));

        if (count($dados) > 0) {
            $data = [
                'aluno_nome' => $dados[0]->aluno_nome,
                'turma_descricao' => $dados[0]->turma_descricao,
                'responsaveis' => $responsaveis,
                'data_hoje' => $data_hoje
            ];

            //Chama o relatório
            $pdf = PDF::loadView('relatorio.declaracaoMatricula', $data);
            return $pdf->download('declaracaoMatricula.pdf');
        } else {
            $aluno = Aluno::find($aluno_id);
            session()->flash('mensagemErro', "Aluno sem matrícula");
            return view('relatorio.listagemRelatoriosAlunos')
                ->with('aluno', $aluno);
        }
    }

    public function declaracaoAdimplencia($aluno_id)
    {
        $dados = DB::table('matriculas')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->select(DB::raw('YEAR(matriculas.matricula_data_ini) as ano'), 'matriculas.matricula_data_fim', 'turmas.turma_descricao', 'alunos.aluno_nome')
            ->where('matriculas.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->whereDate('matriculas.matricula_data_ini', '<=', Carbon::now()->toDateString())
            ->whereNull('matriculas.matricula_data_fim')
            ->get();

        $responsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->get();

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data_hoje = strftime('%d de %B de %Y', strtotime('today'));

        if (count($dados) > 0) {
            $data = [
                'aluno_nome' => $dados[0]->aluno_nome,
                'turma_descricao' => $dados[0]->turma_descricao,
                'responsaveis' => $responsaveis[0]->responsavel_nome,
                'data_hoje' => $data_hoje,
                'ano' => $dados[0]->ano

            ];
            //Chama o relatório
            $pdf = PDF::loadView('relatorio.declaracaoAdimplencia', $data);
            return $pdf->download('declaracaoAdimplencia.pdf');
        } else {
            $aluno = Aluno::find($aluno_id);
            session()->flash('mensagemErro', "Aluno sem matrícula");
            return view('relatorio.listagemRelatoriosAlunos')
                ->with('aluno', $aluno);
        }
    }


    public function listaChamada($turma_id)
    {
        $alunosTurma = DB::table('matriculas')
            ->join('turmas', 'turmas.turma_id', '=', 'matriculas.turma_id')
            ->join('alunos', 'alunos.aluno_id', '=', 'matriculas.aluno_id')
            ->select('alunos.aluno_nome', 'turmas.turma_descricao')
            ->where('matriculas.ativo', 1)
            ->where('turmas.ativo', 1)
            ->where('alunos.ativo', 1)
            ->whereDate('matriculas.matricula_data_ini', '<=', Carbon::now()->toDateString())
            ->whereNull('matriculas.matricula_data_fim')
            ->where('turmas.turma_id', $turma_id)
            ->orderBy('alunos.aluno_nome')
            ->get();

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mes_hoje = strtoupper(strftime('%B - %Y', strtotime('today')));

        $diasNoMes = date("t");
        $AnoMes = strftime('%Y-%m-');
        $diaFds = array();

        for ($i = 1; $i <= $diasNoMes; $i++) {
            $data = date($AnoMes . $i);
            $FimSemana = array($i, (date("w", strtotime($data)) % 6) == 0);
            array_push($diaFds, $FimSemana);
        }

        $data = [
            'alunosTurma' => $alunosTurma,
            'mes_hoje' => $mes_hoje,
            'dias_no_mes' => $diasNoMes,
            'diaFds' => $diaFds
        ];

        //Chama o relatório
        $pdf = PDF::loadView('relatorio.listaChamada', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('chamada.pdf');
    }

    public function printPDF()
    {
        // This  $data array will be passed to our PDF blade
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];

        $pdf = PDF::loadView('relatorio.pdf_view', $data);
        return $pdf->download('medium.pdf');
    }
}