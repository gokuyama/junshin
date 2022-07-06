<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Turma;
use junshin\Aluno;
use PDF;
use Carbon\Carbon;
use DateTimeZone;
use DateTime;
use junshin\TipoEstadoCivil;

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

    public function fichaMatriculaEdInfantPreenchida($aluno_id)
    {
        $aluno = Aluno::find($aluno_id);

        $responsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->get();

        $nome_pai = '';
        $nacionalidade_pai = '';
        $religiao_pai = '';
        $email_pai = '';
        $celular_pai = '';
        $empresa_pai = '';
        $telefone_comercial_pai = '';

        $nome_mae = '';
        $nacionalidade_mae = '';
        $religiao_mae = '';
        $email_mae = '';
        $celular_mae = '';
        $empresa_mae = '';
        $telefone_comercial_mae = '';
        $profissao_pai = '';
        $profissao_mae = '';
        $estadoCivilMae = '';
        $estadoCivilPai = '';

        foreach ($responsaveis as $responsavel) {
            //pai
            if ($responsavel->tipo_responsavel_id == 1) {
                $nome_pai = $responsavel->responsavel_nome;
                $nacionalidade_pai = $responsavel->responsavel_nascionalidade;
                $religiao_pai = $responsavel->responsavel_religiao;
                $email_pai = $responsavel->responsavel_email;
                $celular_pai = $responsavel->responsavel_celular;
                $empresa_pai = $responsavel->responsavel_firma;
                $telefone_comercial_pai = $responsavel->responsavel_telefone_firma;
                $profissao_pai = $responsavel->responsavel_profissao;
                $estado_civil_pai_id = $responsavel->responsavel_estado_civil_id;
                if ($estado_civil_pai_id != null) {
                    $estado_civil_pai = TipoEstadoCivil::where('ativo', 1)->where('estado_civil_id', $estado_civil_pai_id)->orderBy('estado_civil_descricao')->get();
                    $estadoCivilPai = $estado_civil_pai[0]->estado_civil_descricao;
                } else {
                    $estadoCivilPai = null;
                }
            }
            //mãe
            if ($responsavel->tipo_responsavel_id == 2) {
                $nome_mae = $responsavel->responsavel_nome;
                $nacionalidade_mae = $responsavel->responsavel_nascionalidade;
                $religiao_mae = $responsavel->responsavel_religiao;
                $email_mae = $responsavel->responsavel_email;
                $celular_mae = $responsavel->responsavel_celular;
                $empresa_mae = $responsavel->responsavel_firma;
                $telefone_comercial_mae = $responsavel->responsavel_telefone_firma;
                $profissao_mae = $responsavel->responsavel_profissao;
                $estado_civil_mae_id = $responsavel->responsavel_estado_civil_id;
                if ($estado_civil_mae_id != null) {
                    $estado_civil_mae = TipoEstadoCivil::where('ativo', 1)->where('estado_civil_id', $estado_civil_mae_id)->orderBy('estado_civil_descricao')->get();
                    $estadoCivilMae = $estado_civil_mae[0]->estado_civil_descricao;
                } else {
                    $estadoCivilMae = null;
                }
            }
        }


        $moradores = DB::table('moradores')
            ->join('alunos', 'alunos.aluno_id', '=', 'moradores.aluno_id')
            ->where('moradores.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->get();

        $morador1_nome = '';
        $morador1_vinculo = '';
        $morador1_sexo = '';

        $morador2_nome = '';
        $morador2_vinculo = '';
        $morador2_sexo = '';

        $morador3_nome = '';
        $morador3_vinculo = '';
        $morador3_sexo = '';

        if (count($moradores)  > 0) {
            $morador1_nome = $moradores[0]->morador_nome;
            $morador1_vinculo = $moradores[0]->morador_vinculo;
            $morador1_sexo = $moradores[0]->morador_sexo;
        }

        if (count($moradores)  > 1) {
            $morador2_nome = $moradores[1]->morador_nome;
            $morador2_vinculo = $moradores[1]->morador_vinculo;
            $morador2_sexo = $moradores[1]->morador_sexo;
        }

        if (count($moradores)  > 2) {
            $morador3_nome = $moradores[2]->morador_nome;
            $morador3_vinculo = $moradores[2]->morador_vinculo;
            $morador3_sexo = $moradores[2]->morador_sexo;
        }

        $outra_escola = '';
        $escolas = DB::table('historico_instituicoes')
            ->join('alunos', 'alunos.aluno_id', '=', 'historico_instituicoes.aluno_id')
            ->where('historico_instituicoes.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->latest('historico_instituicao_id')->first();

        if ($escolas != null) {
            $outra_escola = $escolas->historico_instituicao_nome;
        }

        $data = [
            'aluno_nome' => $aluno->aluno_nome,
            'aluno_sexo' => $aluno->aluno_sexo,
            'aluno_local_nascimento' => $aluno->aluno_local_nascimento,
            'aluno_data_nascimento' => $aluno->aluno_data_nascimento,
            'tipo_documento_id' => $aluno->tipo_documento_id,
            'aluno_documento' => $aluno->aluno_documento,
            'aluno_endereco_rua' => $aluno->aluno_endereco_rua,
            'aluno_endereco_numero' => $aluno->aluno_endereco_numero,
            'aluno_endereco_complemento' => $aluno->aluno_endereco_complemento,
            'aluno_endereco_bairro' => $aluno->aluno_endereco_bairro,
            'aluno_endereco_cep' => $aluno->aluno_endereco_cep,
            'aluno_telefone_celular' => $aluno->aluno_telefone_celular,
            'aluno_religiao' => $aluno->aluno_religiao,
            'aluno_email' => $aluno->aluno_email,
            'aluno_endereco_cep' => $aluno->aluno_endereco_cep,
            'nome_pai' => $nome_pai,
            'nacionalidade_pai' => $nacionalidade_pai,
            'religiao_pai' => $religiao_pai,
            'email_pai' => $email_pai,
            'celular_pai' => $celular_pai,
            'empresa_pai' => $empresa_pai,
            'telefone_comercial_pai' => $telefone_comercial_pai,
            'profissao_pai' => $profissao_pai,
            'estado_civil_pai' => $estadoCivilPai,
            'nome_mae' => $nome_mae,
            'nacionalidade_mae' => $nacionalidade_mae,
            'religiao_mae' => $religiao_mae,
            'email_mae' => $email_mae,
            'celular_mae' => $celular_mae,
            'empresa_mae' => $empresa_mae,
            'telefone_comercial_mae' => $telefone_comercial_mae,
            'profissao_mae' => $profissao_mae,
            'estado_civil_mae' => $estadoCivilMae,
            'morador1_nome' => $morador1_nome,
            'morador1_vinculo' => $morador1_vinculo,
            'morador1_sexo' => $morador1_sexo,
            'morador2_nome' => $morador2_nome,
            'morador2_vinculo' => $morador2_vinculo,
            'morador2_sexo' => $morador2_sexo,
            'morador3_nome' => $morador3_nome,
            'morador3_vinculo' => $morador3_vinculo,
            'morador3_sexo' => $morador3_sexo,
            'outra_escola' => $outra_escola
        ];

        //return view('relatorio.fichaMatriculaEdInfantPreenc', $data);

        $pdf = PDF::loadView('relatorio.fichaMatriculaEdInfantPreenc', $data);
        return $pdf->download('fichaMatriculaEdInfantPreenc.pdf');
    }

    public function fichaMatriculaCursoJapPreenchida($aluno_id)
    {
        $aluno = Aluno::find($aluno_id);

        $nome_pai = '';
        $nacionalidade_pai = '';
        $religiao_pai = '';
        $email_pai = '';
        $celular_pai = '';
        $empresa_pai = '';
        $telefone_comercial_pai = '';

        $nome_mae = '';
        $nacionalidade_mae = '';
        $religiao_mae = '';
        $email_mae = '';
        $celular_mae = '';
        $empresa_mae = '';
        $telefone_comercial_mae = '';
        $profissao_pai = '';
        $profissao_mae = '';
        $estadoCivilMae = '';
        $estadoCivilPai = '';


        $responsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->get();

        foreach ($responsaveis as $responsavel) {
            //pai
            if ($responsavel->tipo_responsavel_id == 1) {
                $nome_pai = $responsavel->responsavel_nome;
                $nacionalidade_pai = $responsavel->responsavel_nascionalidade;
                $religiao_pai = $responsavel->responsavel_religiao;
                $email_pai = $responsavel->responsavel_email;
                $celular_pai = $responsavel->responsavel_celular;
                $empresa_pai = $responsavel->responsavel_firma;
                $telefone_comercial_pai = $responsavel->responsavel_telefone_firma;
                $profissao_pai = $responsavel->responsavel_profissao;
                $estado_civil_pai_id = $responsavel->responsavel_estado_civil_id;
                if ($estado_civil_pai_id != null) {
                    $estado_civil_pai = TipoEstadoCivil::where('ativo', 1)->where('estado_civil_id', $estado_civil_pai_id)->orderBy('estado_civil_descricao')->get();
                    $estadoCivilPai = $estado_civil_pai[0]->estado_civil_descricao;
                } else {
                    $estadoCivilPai = null;
                }
            }
            //mãe
            if ($responsavel->tipo_responsavel_id == 2) {
                $nome_mae = $responsavel->responsavel_nome;
                $nacionalidade_mae = $responsavel->responsavel_nascionalidade;
                $religiao_mae = $responsavel->responsavel_religiao;
                $email_mae = $responsavel->responsavel_email;
                $celular_mae = $responsavel->responsavel_celular;
                $empresa_mae = $responsavel->responsavel_firma;
                $telefone_comercial_mae = $responsavel->responsavel_telefone_firma;
                $profissao_mae = $responsavel->responsavel_profissao;
                $estado_civil_mae_id = $responsavel->responsavel_estado_civil_id;
                if ($estado_civil_mae_id != null) {
                    $estado_civil_mae = TipoEstadoCivil::where('ativo', 1)->where('estado_civil_id', $estado_civil_mae_id)->orderBy('estado_civil_descricao')->get();
                    $estadoCivilMae = $estado_civil_mae[0]->estado_civil_descricao;
                } else {
                    $estadoCivilMae = null;
                }
            }
        }

        $moradores = DB::table('moradores')
            ->join('alunos', 'alunos.aluno_id', '=', 'moradores.aluno_id')
            ->where('moradores.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->get();

        $morador1_nome = '';
        $morador1_vinculo = '';
        $morador1_sexo = '';

        $morador2_nome = '';
        $morador2_vinculo = '';
        $morador2_sexo = '';

        $morador3_nome = '';
        $morador3_vinculo = '';
        $morador3_sexo = '';

        if (count($moradores)  > 0) {
            $morador1_nome = $moradores[0]->morador_nome;
            $morador1_vinculo = $moradores[0]->morador_vinculo;
            $morador1_sexo = $moradores[0]->morador_sexo;
        }

        if (count($moradores)  > 1) {
            $morador2_nome = $moradores[1]->morador_nome;
            $morador2_vinculo = $moradores[1]->morador_vinculo;
            $morador2_sexo = $moradores[1]->morador_sexo;
        }

        if (count($moradores)  > 2) {
            $morador3_nome = $moradores[2]->morador_nome;
            $morador3_vinculo = $moradores[2]->morador_vinculo;
            $morador3_sexo = $moradores[2]->morador_sexo;
        }

        $outra_escola = '';
        $escolas = DB::table('historico_instituicoes')
            ->join('alunos', 'alunos.aluno_id', '=', 'historico_instituicoes.aluno_id')
            ->where('historico_instituicoes.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->latest('historico_instituicao_id')->first();

        if ($escolas != null) {
            $outra_escola = $escolas->historico_instituicao_nome;
        }

        if ($aluno->aluno_ordem_geracao == 0) {
            $aluno->aluno_ordem_geracao  = '';
        }

        $dataNascimento = $aluno->aluno_data_nascimento;
        $date = new DateTime($dataNascimento);
        $interval = $date->diff(new DateTime(date('Y-m-d')));
        $idade =  $interval->format('%Y anos');

        $data = [
            'aluno_nome' => $aluno->aluno_nome,
            'aluno_sexo' => $aluno->aluno_sexo,
            'aluno_local_nascimento' => $aluno->aluno_local_nascimento,
            'aluno_data_nascimento' => $aluno->aluno_data_nascimento,
            'aluno_idade' => $idade,
            'tipo_documento_id' => $aluno->tipo_documento_id,
            'aluno_documento' => $aluno->aluno_documento,
            'aluno_endereco_rua' => $aluno->aluno_endereco_rua,
            'aluno_endereco_numero' => $aluno->aluno_endereco_numero,
            'aluno_endereco_complemento' => $aluno->aluno_endereco_complemento,
            'aluno_endereco_bairro' => $aluno->aluno_endereco_bairro,
            'aluno_endereco_cep' => $aluno->aluno_endereco_cep,
            'aluno_telefone_celular' => $aluno->aluno_telefone_celular,
            'aluno_religiao' => $aluno->aluno_religiao,
            'aluno_email' => $aluno->aluno_email,
            'aluno_endereco_cep' => $aluno->aluno_endereco_cep,
            'aluno_ordem_geracao' => $aluno->aluno_ordem_geracao,
            'nome_pai' => $nome_pai,
            'nacionalidade_pai' => $nacionalidade_pai,
            'religiao_pai' => $religiao_pai,
            'email_pai' => $email_pai,
            'celular_pai' => $celular_pai,
            'empresa_pai' => $empresa_pai,
            'profissao_pai' => $profissao_pai,
            'estado_civil_pai' => $estadoCivilPai,
            'telefone_comercial_pai' => $telefone_comercial_pai,
            'nome_mae' => $nome_mae,
            'nacionalidade_mae' => $nacionalidade_mae,
            'religiao_mae' => $religiao_mae,
            'email_mae' => $email_mae,
            'celular_mae' => $celular_mae,
            'empresa_mae' => $empresa_mae,
            'telefone_comercial_mae' => $telefone_comercial_mae,
            'profissao_mae' => $profissao_mae,
            'estado_civil_mae' => $estadoCivilMae,
            'morador1_nome' => $morador1_nome,
            'morador1_vinculo' => $morador1_vinculo,
            'morador1_sexo' => $morador1_sexo,
            'morador2_nome' => $morador2_nome,
            'morador2_vinculo' => $morador2_vinculo,
            'morador2_sexo' => $morador2_sexo,
            'morador3_nome' => $morador3_nome,
            'morador3_vinculo' => $morador3_vinculo,
            'morador3_sexo' => $morador3_sexo,
            'outra_escola' => $outra_escola
        ];

        //return view('relatorio.fichaMatriculaCursoJapPreenc', $data);

        $pdf = PDF::loadView('relatorio.fichaMatriculaCursoJapPreenc', $data);
        return $pdf->download('fichaMatriculaCursoJapPreenc.pdf');
    }

    public function fichaMatriculaEducacaoInfantil()
    {
        //Chama o relatório
        $pdf = PDF::loadView('relatorio.fichaMatriculaEdInfant');
        //return view('relatorio.fichaMatriculaEdInfant');
        return $pdf->download('fichaMatriculaEdInfant.pdf');
    }

    public function fichaMatriculaCursoJapones()
    {
        //Chama o relatório
        $pdf = PDF::loadView('relatorio.fichaMatriculaCursoJap');
        //return view('relatorio.fichaMatriculaCursoJap');
        return $pdf->download('fichaMatriculaCursoJap.pdf');
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

    public function contatoAlunos($turma_id)
    {
        $listaAlunos = DB::select('SELECT distinct al.aluno_nome, DATE_FORMAT(al.aluno_data_nascimento,"%d/%m/%Y") as data_nascimento,
            al.aluno_telefone_fixo, tur.turma_descricao, tun.turno_descricao, (select GROUP_CONCAT(res1.responsavel_nome) from responsaveis res1 where res1.aluno_id = al.aluno_id) as responsaveis,
            (select GROUP_CONCAT(res1.responsavel_celular) from responsaveis res1 where res1.aluno_id = al.aluno_id) as celulares
            FROM alunos al, matriculas mat, turmas tur, turnos tun
            where mat.aluno_id = al.aluno_id
            and tur.turma_id = mat.turma_id
            and tun.turno_id = tur.turno_id
            and tur.turma_id = ' . $turma_id .
            ' and tur.ativo = true');

        $data = [
            'listaAlunos' => $listaAlunos
        ];

        //Chama o relatório
        $pdf = PDF::loadView('relatorio.contatoAlunos', $data);
        $pdf->setPaper('A4', 'landscape');
        //return view('relatorio.contatoAlunos');
        return $pdf->download('contatoAlunos.pdf');
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
