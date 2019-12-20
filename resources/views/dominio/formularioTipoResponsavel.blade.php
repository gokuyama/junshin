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

<h1>Novo Tipo de Responsável</h1>
<form action="{{action('TipoResponsavelController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group">
        <label>Tipo de Responsável</label>
        <input name="tipo_responsavel_descricao" class="form-control" value="{{ old('tipo_responsavel_descricao') }}" />
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
    <button type="button" class="btn btn-secondary"
        onclick="location.href='{{action('TipoResponsavelController@lista')}}'">Voltar</button>

</form>

@stop