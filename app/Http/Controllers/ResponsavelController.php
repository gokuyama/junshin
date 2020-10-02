<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\ResponsavelRequest;
use junshin\Http\Requests\LocalizaResponsavelRequest;
use junshin\Pagador;
use junshin\TipoResponsavel;
use junshin\NivelEscolaridade;
use junshin\Aluno;
use junshin\Responsavel;
use Request;
use Carbon\Carbon;
use DateTimeZone;
use junshin\TipoEstadoCivil;

class ResponsavelController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $listaResponsaveis = null;
        if (view()->exists('responsavel.listagemResponsavel')) {
            return view('responsavel.listagemResponsavel')->with('listaResponsaveis', $listaResponsaveis);
        }
    }

    public function localiza(LocalizaResponsavelRequest $request)
    {
        $params = Request::all();
        $listaResponsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->select('responsaveis.responsavel_id', 'responsaveis.responsavel_nome', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('responsavel_nome', 'like', '%' . $params['responsavel_nome_localiza'] . '%')
            ->orderBy('responsaveis.responsavel_nome')
            ->get();

        if (view()->exists('responsavel.listagemResponsavel')) {
            return view('responsavel.listagemResponsavel')
                ->with('listaResponsaveis', $listaResponsaveis)
                ->with('aluno_id', $listaResponsaveis[0]->aluno_id);
        }
    }

    public function localizaResponsavelPorAluno($aluno_id)
    {
        $listaResponsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->select('responsaveis.responsavel_id', 'responsaveis.responsavel_nome', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->orderBy('responsaveis.responsavel_nome')
            ->get();

        if (view()->exists('responsavel.listagemResponsavel')) {
            return view('responsavel.listagemResponsavel')
                ->with('listaResponsaveis', $listaResponsaveis)
                ->with('aluno_id', $aluno_id);
        }
    }

    public function novo()
    {
        $tiposResponsavel = TipoResponsavel::where('ativo', 1)->orderBy('tipo_responsavel_descricao')->get();
        $alunos = Aluno::where('ativo', 1)->orderBy('aluno_nome')->get();
        $niveisEscolaridade = NivelEscolaridade::where('ativo', 1)->orderBy('nivel_escolaridade_descricao')->get();
        $estadosCivil = TipoEstadoCivil::where('ativo', 1)->orderBy('estado_civil_descricao')->get();

        return view('responsavel.formularioResponsavel')
            ->with('alunos', $alunos)
            ->with('niveisEscolaridade', $niveisEscolaridade)
            ->with('tiposResponsavel', $tiposResponsavel)
            ->with('estadosCivil', $estadosCivil);
    }

    public function novoResponsavelPorAluno($aluno_id)
    {
        $tiposResponsavel = TipoResponsavel::where('ativo', 1)->orderBy('tipo_responsavel_descricao')->get();
        $alunos = Aluno::where('ativo', 1)->where('aluno_id', $aluno_id)->get();
        $niveisEscolaridade = NivelEscolaridade::where('ativo', 1)->orderBy('nivel_escolaridade_descricao')->get();
        $estadosCivil = TipoEstadoCivil::where('ativo', 1)->orderBy('estado_civil_descricao')->get();

        return view('responsavel.formularioResponsavel')
            ->with('alunos', $alunos)
            ->with('niveisEscolaridade', $niveisEscolaridade)
            ->with('tiposResponsavel', $tiposResponsavel)
            ->with('estadosCivil', $estadosCivil);
    }

    public function adiciona(ResponsavelRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $aluno_id = Request::input('aluno_id');
        $tipo_responsavel_id = Request::input('tipo_responsavel_id');
        $responsavel_estado_civil_id = Request::input('responsavel_estado_civil_id');
        $responsavel_profissao = Request::input('responsavel_profissao');
        $responsavel_nome = Request::input('responsavel_nome');
        $responsavel_firma = Request::input('responsavel_firma');
        $responsavel_telefone_firma = Request::input('responsavel_telefone_firma');
        $responsavel_ramal_firma = Request::input('responsavel_ramal_firma');
        $responsavel_celular = Request::input('responsavel_celular');
        $responsavel_email = Request::input('responsavel_email');
        $responsavel_nascionalidade = Request::input('responsavel_nascionalidade');
        $responsavel_data_nascimento = Request::input('responsavel_data_nascimento');
        $dt_nascimento = str_replace('/', '-', $responsavel_data_nascimento);
        if ($dt_nascimento != null) {
            $data_nascimento = date("Y-m-d", strtotime($dt_nascimento));
        } else {
            $data_nascimento = null;
        }
        $responsavel_ordem_geracao = Request::input('responsavel_ordem_geracao');
        $responsavel_religiao = Request::input('responsavel_religiao');
        $responsavel_escolaridade_id = Request::input('responsavel_escolaridade_id');
        $pagador_percentual = Request::input('pagador_percentual');
        $pagador_cpf = Request::input('pagador_cpf');
        $pagador_rua = Request::input('pagador_rua');
        $pagador_numero = Request::input('pagador_numero');
        $pagador_complemento = Request::input('pagador_complemento');
        $pagador_bairro = Request::input('pagador_bairro');
        $pagador_cep = Request::input('pagador_cep');
        $pagador_cidade = Request::input('pagador_cidade');
        $pagador_estado = Request::input('pagador_estado');

        $responsavel_id = DB::table('responsaveis')->insertGetId(
            [
                'tipo_responsavel_id' => $tipo_responsavel_id,
                'responsavel_estado_civil_id' => $responsavel_estado_civil_id,
                'responsavel_profissao' => $responsavel_profissao,
                'aluno_id' => $aluno_id,
                'responsavel_nome' => $responsavel_nome,
                'responsavel_firma' => $responsavel_firma,
                'responsavel_telefone_firma' => $responsavel_telefone_firma,
                'responsavel_ramal_firma' => $responsavel_ramal_firma,
                'responsavel_celular' => $responsavel_celular,
                'responsavel_email' => $responsavel_email,
                'responsavel_nascionalidade' => $responsavel_nascionalidade,
                'responsavel_data_nascimento' => $data_nascimento,
                'responsavel_ordem_geracao' => $responsavel_ordem_geracao,
                'responsavel_religiao' => $responsavel_religiao,
                'responsavel_escolaridade_id' => $responsavel_escolaridade_id,
                'responsavel_escolaridade_id' => $responsavel_escolaridade_id,
                'userid_insert' => $usuarioLogado
            ]
        );

        DB::table('pagadores')->insert(
            [
                'responsavel_id' => $responsavel_id,
                'pagador_percentual' => $pagador_percentual,
                'pagador_cpf' => $pagador_cpf,
                'pagador_rua' => $pagador_rua,
                'pagador_numero' => $pagador_numero,
                'pagador_complemento' => $pagador_complemento,
                'pagador_bairro' => $pagador_bairro,
                'pagador_cep' => $pagador_cep,
                'pagador_cidade' => $pagador_cidade,
                'pagador_estado' => $pagador_estado,
                'pagador_data_ini' => Carbon::now(new DateTimeZone('America/Sao_Paulo'))->toDateTimeString(),
                'pagador_data_fim' => null,
                'userid_insert' => $usuarioLogado
            ]
        );


        $listaResponsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->select('responsaveis.responsavel_id', 'responsaveis.responsavel_nome', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->orderBy('responsaveis.responsavel_nome')
            ->get();

        session()->flash('mensagemSucesso', "Responsável adicionado com sucesso");
        if (view()->exists('responsavel.listagemResponsavel')) {
            return view('responsavel.listagemResponsavel')
                ->with('listaResponsaveis', $listaResponsaveis)
                ->with('aluno_id', $aluno_id);
        }
    }

    //exclui um Responsavel
    public function exclui($responsavel_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $responsavel = Responsavel::find($responsavel_id);
        $responsavel->ativo = 0;
        $responsavel->userid_insert = $usuarioLogado;
        $responsavel->save();
        $listaResponsaveis = null;
        $listaResponsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->select('responsaveis.responsavel_id', 'responsaveis.responsavel_nome', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $responsavel->aluno_id)
            ->orderBy('responsaveis.responsavel_nome')
            ->get();

        session()->flash('mensagemSucesso', "Responsável excluído com sucesso");
        if (view()->exists('responsavel.listagemResponsavel')) {
            return view('responsavel.listagemResponsavel')
                ->with('listaResponsaveis', $listaResponsaveis)
                ->with('aluno_id', $listaResponsaveis[0]->aluno_id);
        }
    }

    public function edita($responsavel_id)
    {
        $responsavel = Responsavel::find($responsavel_id);
        $tiposResponsavel = TipoResponsavel::where('ativo', 1)->orderBy('tipo_responsavel_descricao')->get();
        $aluno = Aluno::where('ativo', 1)->where('aluno_id', $responsavel->aluno_id)->first();
        $niveisEscolaridade = NivelEscolaridade::where('ativo', 1)->orderBy('nivel_escolaridade_descricao')->get();
        $estadosCivil = TipoEstadoCivil::where('ativo', 1)->orderBy('estado_civil_descricao')->get();
        $maxId = Pagador::orderBy('pagador_id', 'desc')
            ->where('responsavel_id', $responsavel_id)
            ->value('pagador_id');

        $pagadores = Pagador::where('responsavel_id', $responsavel_id)
            ->where('pagador_data_fim', null)
            ->where('pagador_id', $maxId)
            ->get();
        if (empty($responsavel)) {
            return "Esse responsável não existe";
        }
        if ($responsavel['responsavel_data_nascimento'] == '0000-00-00' || $responsavel['responsavel_data_nascimento'] == null) {
            $responsavel['responsavel_data_nascimento'] = '--';
        }

        return view('responsavel.editaResponsavel')
            ->with('r', $responsavel)
            ->with('aluno', $aluno)
            ->with('niveisEscolaridade', $niveisEscolaridade)
            ->with('tiposResponsavel', $tiposResponsavel)
            ->with('pagadores', $pagadores)
            ->with('estadosCivil', $estadosCivil);
    }

    public function altera(ResponsavelRequest $request, $responsavel_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $responsavel = Responsavel::find($responsavel_id);
        $dataNascimento  = $params['responsavel_data_nascimento'];
        if ($dataNascimento != null) {
            $date = Carbon::createFromFormat('d/m/Y', $dataNascimento);
            $params['responsavel_data_nascimento'] = $date;
        }
        $responsavel->update($params);
        $responsavel->userid_insert = $usuarioLogado;
        $responsavel->save();
        $maxId = Pagador::orderBy('pagador_id', 'desc')
            ->where('responsavel_id', $responsavel_id)
            ->value('pagador_id');

        $pagadorOld = Pagador::where('responsavel_id', $responsavel_id)
            ->where('pagador_id', $maxId)
            ->where('pagador_data_fim', null)->get();

        $percentualNovo = $params['pagador_percentual'];
        if (
            $percentualNovo != $pagadorOld[0]->pagador_percentual ||
            $params['pagador_cpf'] != $pagadorOld[0]->pagador_cpf ||
            $params['pagador_rua'] != $pagadorOld[0]->pagador_rua ||
            $params['pagador_numero'] != $pagadorOld[0]->pagador_numero ||
            $params['pagador_complemento'] != $pagadorOld[0]->pagador_complemento ||
            $params['pagador_bairro'] != $pagadorOld[0]->pagador_bairro ||
            $params['pagador_cep'] != $pagadorOld[0]->pagador_cep ||
            $params['pagador_cidade'] != $pagadorOld[0]->pagador_cidade ||
            $params['pagador_estado'] != $pagadorOld[0]->pagador_estado
        ) {
            $pagadorOld[0]->pagador_data_fim = Carbon::now(new DateTimeZone('America/Sao_Paulo'))->toDateTimeString();
            $pagadorOld[0]->save();
            DB::table('pagadores')->insert(
                [
                    'responsavel_id' => $responsavel_id,
                    'pagador_percentual' => $percentualNovo,
                    'pagador_cpf' =>  $params['pagador_cpf'],
                    'pagador_rua' =>  $params['pagador_rua'],
                    'pagador_numero' =>  $params['pagador_numero'],
                    'pagador_complemento' =>  $params['pagador_complemento'],
                    'pagador_bairro' =>  $params['pagador_bairro'],
                    'pagador_cep' =>  $params['pagador_cep'],
                    'pagador_cidade' =>  $params['pagador_cidade'],
                    'pagador_estado' =>  $params['pagador_estado'],
                    'pagador_data_ini' => Carbon::now(new DateTimeZone('America/Sao_Paulo'))->toDateTimeString(),
                    'pagador_data_fim' => null,
                    'userid_insert' => $usuarioLogado
                ]
            );
        }
        $listaResponsaveis = DB::table('responsaveis')
            ->join('alunos', 'alunos.aluno_id', '=', 'responsaveis.aluno_id')
            ->select('responsaveis.responsavel_id', 'responsaveis.responsavel_nome', 'alunos.aluno_nome', 'alunos.aluno_id')
            ->where('responsaveis.ativo', 1)
            ->where('alunos.aluno_id', $params['aluno_id'])
            ->orderBy('responsaveis.responsavel_nome')
            ->get();

        session()->flash('mensagemSucesso', "Responsável alterado com sucesso");
        if (view()->exists('responsavel.listagemResponsavel')) {
            return view('responsavel.listagemResponsavel')
                ->with('listaResponsaveis', $listaResponsaveis)
                ->with('aluno_id', $listaResponsaveis[0]->aluno_id);
        }
    }
}
