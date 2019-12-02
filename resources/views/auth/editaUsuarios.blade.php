@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Edita Usuário') }}
                    <span style="display: flex; justify-content: flex-end">
                        <a href="{{ url('/') }}" class="btn btn-secondary">Inicio</a>
                    </span>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="col-md-6">
                        @isset($listaUsuarios)
                        <form action="{{action('UsuarioController@seleciona')}}" method="get">
                            <label>Selecione o Usuário</label>
                            <select class="form-control" id="id" name="id">
                                @foreach ($listaUsuarios as $usuario)
                                <option value="{{ $usuario->id }}">
                                    {{ ($usuario->id == old('id') ? 'selected="selected"' : '') }}
                                    {{ $usuario->username }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-secondary" style="margin-top: 10px;">Alterar
                                Usuário</button>
                            </button>
                        </form>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection