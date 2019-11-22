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

<h1>Novo tipo de movimentação</h1>
<form action="{{action('TipoMovimentacaoController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Tipo</label>
                    <select class="form-control" id="tipo_movimentacao" name="tipo_movimentacao">
                        <option value="0" {{ (old('tipo_movimentacao') == 0 ? 'selected' : '') }}>Saída</option>
                        <option value="1" {{ (old('tipo_movimentacao') == 1 ? 'selected' : '') }}>Entrada</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Descrição</label>
                    <input name="tipo_movimentacao_descricao" class="form-control" value="{{ old('tipo_movimentacao_descricao') }}" />
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
</form>

@stop