<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Eduardokum\LaravelBoleto\Pessoa;
use Eduardokum\LaravelBoleto\Boleto\Banco\Caixa;
use Eduardokum\LaravelBoleto\Boleto\Render\Pdf;
use Eduardokum\LaravelBoleto\Boleto\Render\Html;
use Eduardokum\LaravelBoleto\Boleto\Render\PdfCaixa;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto as BoletoContract;
use Eduardokum\LaravelBoleto\Util;



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
            FORMAT((pagadores.pagador_percentual * mensalidades.mensalidade_valor) / 100,2) AS valor,
            pagadores.pagador_id as pagador_id,
            boletos.ativo as boleto_ativo
        FROM alunos
                JOIN    matriculas ON alunos.aluno_id = matriculas.aluno_id
                JOIN    mensalidades ON matriculas.matricula_id = mensalidades.matricula_id
                JOIN    responsaveis ON alunos.aluno_id = responsaveis.aluno_id
                JOIN    pagadores ON responsaveis.responsavel_id = pagadores.responsavel_id
                LEFT JOIN boletos ON pagadores.pagador_id = boletos.pagador_id
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

        $nossonumeroDb = DB::select('SELECT MAX(boleto_id) as boleto_id FROM boletos');
        $nossonumero = $nossonumeroDb[0]->boleto_id + 1;
        $remessaDb = DB::select('SELECT MAX(remessa_id) as remessa_id FROM remessas');
        $remessaId = $remessaDb[0]->remessa_id + 1;
        $usuarioLogado=\Auth::user()->username;
        $boletos = [];
        
        $beneficiario = $this->geraBeneficiario();

        foreach ($listagemBoletos as $b)
        {
            DB::table('boletos')->insert(
                [
                    'remessa_id' => $remessaId,
                    'boleto_id' => $nossonumero,
                    'boleto_valor' => $b->valor,
                    'data_competencia' => new \Carbon\Carbon(),
                    'boleto_vencimento' => new \Carbon\Carbon(),
                    'boleto_observacao' => 'Teste demonstrativo',
                    'boleto_pago' => 0,
                    'email_enviado' => 0,
                    'ativo' => 1,
                    'userid_insert' => $usuarioLogado
                ]
            );
            $boleto=$this->preencheBoleto($beneficiario, $b,  $nossonumero);
            $boletos[] = $boleto;
            $nossonumero++;
            
        }
        if(!empty($boletos)){
            $this->geraRemessa($beneficiario, $remessaId, $boletos);
        }
        //$this->processaRetorno();

        if (view()->exists('boleto.listagemBoleto')) {
            return view('boleto.listagemBoleto')
                ->with('listagemBoletos', $listagemBoletos);
        }
    }

    public function geraBeneficiario(){
        $beneficiario = new Pessoa(
            [
                'nome'      => 'Escola Junshin',
                'endereco'  => 'R. Nunes Machado, 289',
                'cep'       => '80250-000',
                'uf'        => 'PR',
                'cidade'    => 'CURITIBA',
                'documento' => '75.986.968/0002-19',
            ]
        );
        return $beneficiario;
    }

    public function preencheBoleto($beneficiario, $b, $nossonumero){
            $pagador = new Pessoa(
            [
                'nome'      => 'Aluno:' . $b->aluno_nome . ' | Reponsável:' . $b->nome_responsavel,
                'endereco'  => $b->endereco,
                'bairro'    => $b->bairro,
                'cep'       => $b->cep,
                'uf'        => $b->UF,
                'cidade'    => $b->cidade,
                'documento' => $b->documento,
            ]
        );
        
        $boleto = new Caixa(
            [
                'logo'                   => realpath(__DIR__ . '/../logos/') . DIRECTORY_SEPARATOR . '104.png',
                'dataVencimento'         => new \Carbon\Carbon(),
                'valor'                  => $b->valor,
                'multa'                  => false,
                'juros'                  => false,
                'numero'                 => $nossonumero,
                'numeroDocumento'        => $nossonumero,
                'pagador'                => $pagador,
                'beneficiario'           => $beneficiario,
                'agencia'                => 1234,
                'conta'                  => 123456,
                'carteira'               => 'RG',
                'codigoCliente'          => 1324992,
                'descricaoDemonstrativo' => ['Teste demonstrativo'],
                'instrucoes'             => ['Desconto de 10% até o vencimento'],
                'aceite'                 => 'S',
                'especieDoc'             => 'DM',
            ]
        );
        $pdf = new PdfCaixa();
        $pdf->addBoleto($boleto);
        $pdf->gerarBoleto($pdf::OUTPUT_SAVE, __DIR__ . DIRECTORY_SEPARATOR . 'arquivos' . DIRECTORY_SEPARATOR . $nossonumero . '.pdf');

        return $boleto;
    }

    public function geraRemessa($beneficiario, $remessaId, $boletos){

        $usuarioLogado=\Auth::user()->username;

        $remessa = new \Eduardokum\LaravelBoleto\Cnab\Remessa\Cnab400\Banco\Caixa(
            [
                'agencia'       => 1234,
                'idRemessa'     => $remessaId,
                'conta'         => 123456,
                'carteira'      => 'RG',
                'codigoCliente' => 1324992,
                'beneficiario'  => $beneficiario,
            ]
        );

        $remessa->addBoletos($boletos);
        DB::table('remessas')->insert(
            [
                'remessa_id' => $remessaId,
                'ativo' => 1,
                'datahora_insert' => new \Carbon\Carbon(),
                'userid_insert' => $usuarioLogado
            ]
        );
    
        $remessa->save(__DIR__ . DIRECTORY_SEPARATOR . 'arquivos' . DIRECTORY_SEPARATOR . 'remessa'.$remessaId.'txt');
    }

    public function processaRetorno(){

        $retorno = \Eduardokum\LaravelBoleto\Cnab\Retorno\Factory::make(__DIR__ . DIRECTORY_SEPARATOR . 'arquivos' . DIRECTORY_SEPARATOR . 'cef.ret');
        $retorno->processar();

        $detalheCollection = $retorno->getDetalhes();
        foreach($detalheCollection as $detalhe) {
            $numeroDocumento=$detalhe->numeroDocumento;
            $dataRecebimento=$detalhe->dataOcorrencia;
            $valorRecebido=$detalhe->valorRecebido;
            if($valorRecebido>0){
                DB::update('UPDATE boletos set boleto_pago=1 where boleto_id='.$numeroDocumento);
            }
                        
        }

    }

}