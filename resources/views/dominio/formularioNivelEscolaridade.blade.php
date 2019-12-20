@extends('layout.principal')
@section('conteudo')
<!--mensagens de erro-->
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1>Novo Nível de Escolaridade</h1>
<form action="{{action('NivelEscolaridadeController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group">
        <label>Nível de Escolaridade</label>
        <input name="nivel_escolaridade_descricao" class="form-control"
            value="{{ old('nivel_escolaridade_descricao') }}" />
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
    <button type="button" class="btn btn-secondary"
        onclick="location.href='{{action('NivelEscolaridadeController@lista')}}'">Voltar</button>

</form>

@stop