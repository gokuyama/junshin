<?php

namespace junshin\Http\Controllers\Auth;

use junshin\User;
use junshin\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use junshin\UserPorPerfil;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:45', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'administrador' => [],
            'secretaria' => [],
            'balancete' => [],
            'professor' => [],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \junshin\User
     */
    protected function create(array $data)
    {
        $usuarioLogado = \Auth::user()->username;
        $usuario = \Auth::user();

        $perfis = UserPorPerfil::where('user_id', $usuario->id)->get(['perfil_id']);

        if ($perfis->contains('perfil_id', '1', '2')) {
            $novoUsuario = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if (array_key_exists("administrador", $data)) {
                DB::table('users_por_perfis')->insert(
                    [
                        'user_id' => $novoUsuario->id,
                        'perfil_id' => $data['administrador'],
                        'userid_insert' => $usuarioLogado
                    ]
                );
            }
            if (array_key_exists("secretaria", $data)) {
                DB::table('users_por_perfis')->insert(
                    [
                        'user_id' => $novoUsuario->id,
                        'perfil_id' => $data['secretaria'],
                        'userid_insert' => $usuarioLogado
                    ]
                );
            }
            if (array_key_exists("balancete", $data)) {
                DB::table('users_por_perfis')->insert(
                    [
                        'user_id' => $novoUsuario->id,
                        'perfil_id' => $data['balancete'],
                        'userid_insert' => $usuarioLogado
                    ]
                );
            }
            if (array_key_exists("professor", $data)) {
                DB::table('users_por_perfis')->insert(
                    [
                        'user_id' => $novoUsuario->id,
                        'perfil_id' => $data['professor'],
                        'userid_insert' => $usuarioLogado
                    ]
                );
            }

            session()->flash('message', "Usuário {$novoUsuario->name} cadastrado com sucesso");
            return $usuario;
        } else {
            session()->flash('message', 'Somente usuário com perfil Administrador pode cadastrar usuário');
            return $usuario;
        }
    }
}