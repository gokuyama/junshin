<?php

namespace junshin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use junshin\User;
use junshin\UserPorPerfil;
use Request;
use Illuminate\Support\Facades\Hash;


class UsuarioController  extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function edita()
    {
        $listaUsuarios = DB::select('select users.id, users.name, users.username from users where  users.ativo=1 order by 2');
        return view('auth.editaUsuarios')->with('listaUsuarios', $listaUsuarios);
    }

    public function seleciona()
    {
        $manutencao = false;
        $administrador = false;
        $secretaria = false;
        $balancete = false;
        $professor = false;
        $params = Request::all();

        $usuario = DB::table('users')->where('id', $params['id'])->first();
        $perfis = UserPorPerfil::where('user_id', $usuario->id)->where('ativo', 1)->get(['perfil_id']);
        if ($perfis->contains('perfil_id', '1')) {
            $manutencao = true;
        }
        if ($perfis->contains('perfil_id', '2')) {
            $administrador = true;
        }
        if ($perfis->contains('perfil_id', '3')) {
            $secretaria = true;
        }
        if ($perfis->contains('perfil_id', '4')) {
            $balancete = true;
        }
        if ($perfis->contains('perfil_id', '5')) {
            $professor = true;
        }
        return view('auth.alteraUsuarios')
            ->with('usuario', $usuario)
            ->with('manutencao', $manutencao)
            ->with('administrador', $administrador)
            ->with('secretaria', $secretaria)
            ->with('balancete', $balancete)
            ->with('professor', $professor);
    }

    public function alteraUsuario($userId)
    {
        $usuarioLogado = \Auth::user()->username;
        $usuario = DB::table('users')->where('id', $userId)->first();
        $params = Request::all();

        $manutencao = false;
        $administrador = false;
        $secretaria = false;
        $balancete = false;
        $professor = false;

        $nome = $params['name'];
        $email = $params['email'];

        DB::update('UPDATE users set name=? , email=? where id= ?', [$nome, $email, $userId]);
        $usuario = DB::table('users')->where('id', $userId)->first();
        session()->flash('message', 'O usuário foi alterado com sucesso!');


        $perfis = UserPorPerfil::where('user_id', $userId)->where('ativo', 1)->get(['perfil_id']);
        if ($perfis->contains('perfil_id', '1')) {
            $manutencao = true;
        }
        if ($perfis->contains('perfil_id', '2')) {
            $administrador = true;
        }
        if ($perfis->contains('perfil_id', '3')) {
            $secretaria = true;
        }
        if ($perfis->contains('perfil_id', '4')) {
            $balancete = true;
        }
        if ($perfis->contains('perfil_id', '5')) {
            $professor = true;
        }

        //administrador
        if (array_key_exists('administrador', $params) && !$administrador) {
            DB::table('users_por_perfis')->insert(
                [
                    'user_id' => $userId,
                    'perfil_id' => 2,
                    'userid_insert' => $usuarioLogado
                ]
            );
            $administrador = true;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }
        if (!array_key_exists('administrador', $params) && $administrador) {
            $userPorPerfil = UserPorPerfil::where('ativo', 1)->where('user_id', $userId)->where('perfil_id', 2)->first();
            $userPorPerfil->ativo = 0;
            $userPorPerfil->userid_insert = $usuarioLogado;
            $userPorPerfil->save();
            $administrador = false;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }
        //secretaria
        if (array_key_exists('secretaria', $params) && !$secretaria) {
            DB::table('users_por_perfis')->insert(
                [
                    'user_id' => $userId,
                    'perfil_id' => 3,
                    'userid_insert' => $usuarioLogado
                ]
            );
            $secretaria = true;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }
        if (!array_key_exists('secretaria', $params) && $secretaria) {
            $userPorPerfil = UserPorPerfil::where('ativo', 1)->where('user_id', $userId)->where('perfil_id', 3)->first();
            $userPorPerfil->ativo = 0;
            $userPorPerfil->userid_insert = $usuarioLogado;
            $userPorPerfil->save();
            $secretaria = false;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }
        //balancete
        if (array_key_exists('balancete', $params) && !$balancete) {
            DB::table('users_por_perfis')->insert(
                [
                    'user_id' => $userId,
                    'perfil_id' => 4,
                    'userid_insert' => $usuarioLogado
                ]
            );
            $balancete = true;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }
        if (!array_key_exists('balancete', $params) && $balancete) {
            $userPorPerfil = UserPorPerfil::where('ativo', 1)->where('user_id', $userId)->where('perfil_id', 4)->first();
            $userPorPerfil->ativo = 0;
            $userPorPerfil->userid_insert = $usuarioLogado;
            $userPorPerfil->save();
            $balancete = false;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }
        //professor
        if (array_key_exists('professor', $params) && !$professor) {
            DB::table('users_por_perfis')->insert(
                [
                    'user_id' => $userId,
                    'perfil_id' => 5,
                    'userid_insert' => $usuarioLogado
                ]
            );
            session()->flash('message', 'O usuário foi alterado com sucesso!');
            $professor = true;
        }
        if (!array_key_exists('professor', $params) && $professor) {
            $userPorPerfil = UserPorPerfil::where('ativo', 1)->where('user_id', $userId)->where('perfil_id', 5)->first();
            $userPorPerfil->ativo = 0;
            $userPorPerfil->userid_insert = $usuarioLogado;
            $userPorPerfil->save();
            $professor = false;
            session()->flash('message', 'O usuário foi alterado com sucesso!');
        }

        return view('auth.alteraUsuarios')
            ->with('usuario', $usuario)
            ->with('manutencao', $manutencao)
            ->with('administrador', $administrador)
            ->with('secretaria', $secretaria)
            ->with('balancete', $balancete)
            ->with('professor', $professor);
    }

    public function exclui($userId)
    {
        $usuarioLogado = \Auth::user()->username;
        $user = User::find($userId);
        $user->ativo = 0;
        $user->userid_insert = $usuarioLogado;
        $user->save();
        $listaUsuarios = DB::select('select users.id, users.name, users.username from users where  users.ativo=1 order by 2');
        session()->flash('message', 'O usuário foi excluído com sucesso!');

        return view('auth.editaUsuarios')->with('listaUsuarios', $listaUsuarios);
    }

    public function alteraSenha()
    {
        return view('auth.alteraSenha');
    }

    public function editaSenha()
    {
        $params = Request::all();
        $password = Hash::make($params['password']);
        $userId = \Auth::user()->id;

        DB::update('UPDATE users set password=? where id= ?', [$password, $userId]);
        session()->flash('message', 'A senha foi alterada com sucesso!');

        return view('auth.alteraSenha');
    }
    public function redefineSenha($userId)
    {
        $password = Hash::make('junshin');
        DB::update('UPDATE users set password=? where id= ?', [$password, $userId]);
        $usuario = DB::table('users')->where('id', $userId)->first();
        session()->flash('message', "A nova senha do usuário {$usuario->username} é junshin");
        $listaUsuarios = DB::select('select users.id, users.name, users.username from users where  users.ativo=1 order by 2');
        return view('auth.editaUsuarios')->with('listaUsuarios', $listaUsuarios);
    }
}