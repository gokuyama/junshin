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

<h1>Nova Mensalidade</h1>
<form action="{{action('MensalidadeController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label>Mensalidade</label>
                <input name="mensalidade_valor" class="form-control money" value="{{ old('mensalidade_valor') }}" />
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Data de Início</label>
                <input name="mensalidade_data_ini" class="form-control mask-date"
                    value="{{ old('mensalidade_data_ini') }}" />
            </div>
        </div>
    </div>
    <input type="hidden" name="matricula_id" class="form-control" value="{{ $matricula_id }}" />
    <button class="btn btn-primary" type="submit">Cadastrar</button>
</form>
<script>
jQuery(function($) {
    $(".mask-date").mask("99/99/9999");
    $(".money").mask("#.##0,00", {
        reverse: true
    });
});
</script>
@stop