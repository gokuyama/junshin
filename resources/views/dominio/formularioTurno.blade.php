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

<h1>Novo Turno</h1>
<form action="{{action('TurnoController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group">
        <label>Turno</label>
        <input name="turno_descricao" class="form-control" value="{{ old('turno_descricao') }}" />
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
    <button type="button" class="btn btn-secondary"
        onclick="location.href='{{action('TurnoController@lista')}}'">Voltar</button>

</form>

@stop