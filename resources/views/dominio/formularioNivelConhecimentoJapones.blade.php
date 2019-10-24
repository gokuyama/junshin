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

<h1>Novo Nível de Conhecimento de Japonês</h1>
<form action="{{action('NivelConhecimentoJaponesController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group">
        <label>Nível de Conhecimento de Japonês</label>
        <input name="nivel_conhecimento_japones_descricao" class="form-control" value="{{ old('nivel_conhecimento_japones_descricao') }}" />
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
</form>

@stop