<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\AlunoRequest;
use junshin\Http\Requests\LocalizaAlunoRequest;
use junshin\Aluno;
use junshin\TipoDocumento;
use junshin\NivelEscolaridade;
use junshin\NivelConhecimentoJapones;
use Request;
use Carbon\Carbon;

class AlunoController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $alunos = null;
        if (view()->exists('aluno.listagem')) {
            return view('aluno.listagem')->with('alunos', $alunos);
        }
    }

    public function localiza(LocalizaAlunoRequest $request)
    {
        $params = Request::all();
        //        $alunos = Aluno::where('aluno_nome',$params)->get();
        $alunos = Aluno::where('aluno_nome', 'like', '%' . $params['aluno_nome_localiza'] . '%')
            ->where('ativo', 1)->get();

        if (view()->exists('aluno.listagem')) {
            return view('aluno.listagem')->with('alunos', $alunos);
        }
    }

    public function novo()
    {
        $tiposDocumento = TipoDocumento::where('ativo', 1)->orderBy('tipo_documento_descricao')->get();
        $niveisEscolaridade = NivelEscolaridade::where('ativo', 1)->orderBy('nivel_escolaridade_descricao')->get();
        $niveisConhecimentoJapones = NivelConhecimentoJapones::where('ativo', 1)->orderBy('nivel_conhecimento_japones_descricao')->get();

        return view('aluno.formularioAluno')
            ->with('tiposDocumento', $tiposDocumento)
            ->with('niveisEscolaridade', $niveisEscolaridade)
            ->with('niveisConhecimentoJapones', $niveisConhecimentoJapones);
    }

    public function adiciona(AlunoRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $aluno_nome = Request::input('aluno_nome');
        $aluno_codigo = Request::input('aluno_codigo');
        $aluno_data_nascimento = Request::input('aluno_data_nascimento');
        $dt_nascimento = str_replace('/', '-', $aluno_data_nascimento);
        $data_nascimento = date("Y-m-d", strtotime($dt_nascimento));
        $aluno_local_nascimento = Request::input('aluno_local_nascimento');
        $tipo_documento_id = Request::input('tipo_documento_id');
        $aluno_documento = Request::input('aluno_documento');
        $aluno_sexo = Request::input('aluno_sexo');
        $nivel_escolaridade_id = Request::input('nivel_escolaridade_id');
        $aluno_endereco_rua = Request::input('aluno_endereco_rua');
        $aluno_endereco_numero = Request::input('aluno_endereco_numero');
        $aluno_endereco_complemento = Request::input('aluno_endereco_complemento');
        $aluno_endereco_bairro = Request::input('aluno_endereco_bairro');
        $aluno_endereco_cep = Request::input('aluno_endereco_cep');
        $aluno_endereco_cidade = Request::input('aluno_endereco_cidade');
        $aluno_endereco_estado = Request::input('aluno_endereco_estado');
        $aluno_telefone_fixo = Request::input('aluno_telefone_fixo');
        $aluno_telefone_celular = Request::input('aluno_telefone_celular');
        $aluno_telefone_recado = Request::input('aluno_telefone_recado');
        $aluno_religiao = Request::input('aluno_religiao');
        $aluno_email = Request::input('aluno_email');
        $aluno_observacao = Request::input('aluno_observacao');
        $aluno_quantidade_irmaos = Request::input('aluno_quantidade_irmaos');
        $aluno_ordem_nascimento = Request::input('aluno_ordem_nascimento');
        $aluno_ordem_geracao = Request::input('aluno_ordem_geracao');
        $nivel_conhecimento_japones_id = Request::input('nivel_conhecimento_japones_id');
        $aluno_vacinado = Request::input('aluno_vacinado');
        $aluno_vacinado_observacao = Request::input('aluno_vacinado_observacao');

        DB::table('alunos')->insert(
            [
                'aluno_nome' => $aluno_nome,
                'aluno_codigo' => $aluno_codigo,
                'aluno_data_nascimento' => $data_nascimento,
                'aluno_local_nascimento' => $aluno_local_nascimento,
                'tipo_documento_id' => $tipo_documento_id,
                'aluno_documento' => $aluno_documento,
                'aluno_sexo' => $aluno_sexo,
                'nivel_escolaridade_id' => $nivel_escolaridade_id,
                'aluno_endereco_rua' => $aluno_endereco_rua,
                'aluno_endereco_numero' => $aluno_endereco_numero,
                'aluno_endereco_complemento' => $aluno_endereco_complemento,
                'aluno_endereco_bairro' => $aluno_endereco_bairro,
                'aluno_endereco_cep' => $aluno_endereco_cep,
                'aluno_endereco_cidade' => $aluno_endereco_cidade,
                'aluno_endereco_estado' => $aluno_endereco_estado,
                'aluno_telefone_fixo' => $aluno_telefone_fixo,
                'aluno_telefone_celular' => $aluno_telefone_celular,
                'aluno_telefone_recado' => $aluno_telefone_recado,
                'aluno_religiao' => $aluno_religiao,
                'aluno_email' => $aluno_email,
                'aluno_observacao' => $aluno_observacao,
                'aluno_quantidade_irmaos' => $aluno_quantidade_irmaos,
                'aluno_ordem_nascimento' => $aluno_ordem_nascimento,
                'aluno_ordem_geracao' => $aluno_ordem_geracao,
                'nivel_conhecimento_japones_id' => $nivel_conhecimento_japones_id,
                'aluno_vacinado' => $aluno_vacinado,
                'aluno_vacinado_observacao' => $aluno_vacinado_observacao,
                'userid_insert' => $usuarioLogado
            ]
        );
        session()->flash('mensagemSucesso', 'O aluno ' . $aluno_nome . ' foi cadastrado com sucesso!');
        return redirect()->action('AlunoController@lista')->withInput(Request::only('aluno_nome'));
    }

    //exclui um aluno
    public function exclui($aluno_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $aluno = Aluno::find($aluno_id);
        $aluno->ativo = 0;
        $aluno->userid_insert = $usuarioLogado;
        $aluno->save();
        session()->flash('mensagemSucesso', 'O aluno ' . $aluno->aluno_nome . ' foi excluído com sucesso!');
        return redirect()->action('AlunoController@lista');
    }

    public function edita($aluno_id)
    {
        $aluno = Aluno::find($aluno_id);
        $tiposDocumento = TipoDocumento::where('ativo', 1)->orderBy('tipo_documento_descricao')->get();
        $niveisEscolaridade = NivelEscolaridade::where('ativo', 1)->orderBy('nivel_escolaridade_descricao')->get();
        $niveisConhecimentoJapones = NivelConhecimentoJapones::where('ativo', 1)->orderBy('nivel_conhecimento_japones_descricao')->get();
        if (empty($aluno)) {
            session()->flash('mensagemErro', 'Esse aluno não existe');
        }
        return view('aluno.editaAluno')->with('a', $aluno)
            ->with('tiposDocumento', $tiposDocumento)
            ->with('niveisEscolaridade', $niveisEscolaridade)
            ->with('niveisConhecimentoJapones', $niveisConhecimentoJapones);
    }

    public function altera(AlunoRequest $request, $aluno_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $aluno = Aluno::find($aluno_id);
        $dataNascimento  = $params['aluno_data_nascimento'];
        $date = Carbon::createFromFormat('d/m/Y', $dataNascimento);
        $params['aluno_data_nascimento'] = $date;
        $aluno->update($params);
        $aluno->userid_insert = $usuarioLogado;
        $aluno->save();
        session()->flash('mensagemSucesso', 'O aluno ' . $aluno->aluno_nome . ' foi alterado com sucesso!');
        return redirect()->action('AlunoController@lista')
            ->withInput(Request::only('aluno_nome'));
    }
}