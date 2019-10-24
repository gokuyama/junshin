<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\Http\Requests\MoradorRequest;
use junshin\Morador;
use junshin\Aluno;
use Request;
use Carbon\Carbon;

class MoradorController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function lista()
    {
        $listaMoradores = null;
        if (view()->exists('morador.listagemMorador')) {
            return view('morador.listagemMorador')->with('listaMoradores', $listaMoradores);
        }
    }

    public function localizaMoradorPorAluno($aluno_id)
    {
        $listaMoradores = DB::table('moradores')
            ->join('alunos', 'alunos.aluno_id', '=', 'moradores.aluno_id')
            ->select('moradores.morador_id', 'moradores.morador_nome', 'alunos.aluno_nome')
            ->where('moradores.ativo', 1)
            ->where('alunos.aluno_id', $aluno_id)
            ->orderBy('moradores.morador_nome')
            ->get();

        if (view()->exists('morador.listagemMorador')) {
            return view('morador.listagemMorador')
                ->with('listaMoradores', $listaMoradores)
                ->with('aluno_id', $aluno_id);
        }
    }

    public function novo()
    {
        return view('morador.formularioMorador');
    }

    public function novoMoradorPorAluno($aluno_id)
    {
        $alunos = Aluno::where('ativo', 1)->where('aluno_id', $aluno_id)->get();

        return view('morador.formularioMorador')
            ->with('alunos', $alunos);
    }

    public function adiciona(MoradorRequest $request)
    {
        $usuarioLogado = \Auth::user()->username;
        $aluno_id = Request::input('aluno_id');
        $morador_nome = Request::input('morador_nome');
        $morador_vinculo = Request::input('morador_vinculo');
        $morador_data_nascimento = Request::input('morador_data_nascimento');
        $dt_nascimento = str_replace('/', '-', $morador_data_nascimento);
        if ($dt_nascimento != null) {
            $data_nascimento = date("Y-m-d", strtotime($dt_nascimento));
        } else {
            $data_nascimento = null;
        }
        $morador_sexo = Request::input('morador_sexo');

        DB::table('moradores')->insertGetId(
            [
                'aluno_id' => $aluno_id,
                'morador_nome' => $morador_nome,
                'morador_vinculo' => $morador_vinculo,
                'morador_data_nascimento' => $data_nascimento,
                'morador_sexo' => $morador_sexo,
                'userid_insert' => $usuarioLogado
            ]
        );

        return  $this->localizaMoradorPorAluno($aluno_id)
            ->with('mensagemOk', 'O morador ' . $morador_nome . ' foi adicionado com sucesso!');
    }

    //exclui um Morador
    public function exclui($morador_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $morador = Morador::find($morador_id);
        $morador->ativo = 0;
        $morador->userid_insert = $usuarioLogado;
        $morador->save();

        return  $this->localizaMoradorPorAluno($morador->aluno_id)
            ->with('mensagemOk', 'O morador ' . $morador->morador_nome . ' foi excluído com sucesso!');
    }

    public function edita($morador_id)
    {
        $morador = Morador::find($morador_id);
        $alunos = Aluno::where('ativo', 1)->orderBy('aluno_nome')->get();
        if (empty($morador)) {
            return "Esse responsável não existe";
        }
        return view('morador.editaMorador')
            ->with('m', $morador)
            ->with('alunos', $alunos);
    }

    public function altera(MoradorRequest $request, $morador_id)
    {
        $usuarioLogado = \Auth::user()->username;
        $params = Request::all();
        $morador = Morador::find($morador_id);
        $dataNascimento  = $params['morador_data_nascimento'];
        $date = Carbon::createFromFormat('d/m/Y', $dataNascimento);
        $params['morador_data_nascimento'] = $date;
        $morador->update($params);
        $morador->userid_insert = $usuarioLogado;
        $morador->save();

        return  $this->localizaMoradorPorAluno($params['aluno_id'])
            ->with('mensagemOk', 'O morador ' . $morador->morador_nome . ' foi alterado com sucesso!');
    }
}