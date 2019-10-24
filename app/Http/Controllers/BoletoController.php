<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;


class BoletoController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function listaPorAluno()
    {

        $listagemBoletos = DB::select('
        SELECT 
            alunos.aluno_nome,
            responsaveis.responsavel_nome AS nome_responsavel,
            CONCAT(pagadores.pagador_rua,",",pagadores.pagador_numero," ",
            pagadores.pagador_complemento) AS endereco,
            pagadores.pagador_bairro AS bairro,
            pagadores.pagador_cep AS cep,
            pagadores.pagador_estado AS UF,
            pagadores.pagador_cidade AS cidade,
            pagadores.pagador_cpf AS documento,
            FORMAT((pagadores.pagador_percentual * mensalidades.mensalidade_valor) / 100,2) AS valor
        FROM alunos
                JOIN    matriculas ON alunos.aluno_id = matriculas.aluno_id
                JOIN    mensalidades ON matriculas.matricula_id = mensalidades.matricula_id
                JOIN    responsaveis ON alunos.aluno_id = responsaveis.aluno_id
                JOIN    pagadores ON responsaveis.responsavel_id = pagadores.responsavel_id
        WHERE    matriculas.matricula_data_ini > DATE_FORMAT(NOW(), "%Y-01-01")
                AND matriculas.matricula_data_fim > NOW()
                AND matriculas.ativo = 1
                AND mensalidade_data_ini > DATE_FORMAT(NOW(), "%Y-01-01")
                AND mensalidade_data_fim > NOW()
                AND mensalidades.ativo = 1
                AND pagador_percentual > 0
                AND pagador_data_ini > DATE_FORMAT(NOW(), "%Y-01-01")
                AND pagador_data_fim IS NULL
                AND pagadores.ativo = 1
                AND responsaveis.ativo = 1');

        if (view()->exists('boleto.listagemBoleto')) {
            return view('boleto.listagemBoleto')
                ->with('listagemBoletos', $listagemBoletos);
        }
    }
}