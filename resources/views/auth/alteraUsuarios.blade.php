@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Edita Usuário:')  }}
                    {{$usuario->username}}
                    <div style="display: flex; justify-content: flex-end">
                        <div>
                            <a href="{{ url('/usuario/edita') }}" class="btn btn-secondary">Voltar</a>
                            <a href="{{ url('/') }}" class="btn btn-secondary">Inicio</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    @csrf
                    @isset($usuario)
                    <form action="{{action('UsuarioController@alteraUsuario',$usuario->id)}}" method="get">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $usuario->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $usuario->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-4 col-form-label text-md-right">{{ __('Selecione o(s) Perfi(s):') }}</label>
                            <div class="col-md-6">
                                <input type="checkbox" id="administrador" name="administrador" value="2"
                                    @if($administrador) checked=checked @endif>
                                Administrador<br>
                                <input type="checkbox" id="secretaria" name="secretaria" value="3" @if($secretaria)
                                    checked=checked @endif>
                                Secretaria<br>
                                <input type="checkbox" id="balancete" name="balancete" value="4" @if($balancete)
                                    checked=checked @endif> Balancete<br>
                                <input type="checkbox" id="professor" name="professor" value="5" @if($professor)
                                    checked=checked @endif> Professor<br>
                                <input type="checkbox" id="responsavel" name="responsavel" value="6" @if($responsavel)
                                checked=checked @endif> Responsável<br>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Alterar') }}
                                </button>
                                <button type="button" class="btn btn-secondary"
                                    onclick="location.href='{{action('UsuarioController@exclui', $usuario->id)}}'">
                                    Excluir Usuário
                                </button>
                                <button type="button" class="btn btn-secondary"
                                    onclick="location.href='{{action('UsuarioController@redefineSenha', $usuario->id)}}'">
                                    Redefinir Senha
                                </button>
                            </div>
                        </div>
                    </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection