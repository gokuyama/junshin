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

<h1>Nova saída</h1>
<form action="{{action('MovimentacaoController@adicionaSaida')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Tipos de saídas</label>
                    <select class="form-control" id="tipo_movimentacao_id" name="tipo_movimentacao_id">
                        <option value="">--</option>
                        @foreach ($tiposMovimentacao as $tipoMovimentacao)
                        <option value="{{ $tipoMovimentacao->tipo_movimentacao_id }}"
                            {{ ($tipoMovimentacao->tipo_movimentacao_id == old('tipo_movimentacao_id') ? 'selected' : '') }}>
                            {{ $tipoMovimentacao->tipo_movimentacao_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Data</label>
                    <input name="movimentacao_data" id="movimentacao_data" class="form-control" value="{{ old('movimentacao_data') }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Valor</label>
                    <input name="movimentacao_valor" class="form-control" value="{{ old('movimentacao_valor') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Observação</label>
                    <input name="movimentacao_observacao" class="form-control" value="{{ old('movimentacao_observacao') }}" />
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
</form>

<script>
jQuery(function($) {

    $('#movimentacao_data').datepicker({
    weekStart: 1,
    todayBtn: true,
    clearBtn: true,
    language: "pt-BR",
    daysOfWeekHighlighted: "0,6",
    calendarWeeks: true,
    todayHighlight: true
    });

});
</script>

@stop