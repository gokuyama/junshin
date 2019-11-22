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

<h1>Editando entrada:</h1>
<form action="{{action('MovimentacaoController@alteraEntrada',$t->movimentacao_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Tipos de entradas</label>
                    <select class="form-control" id="tipo_movimentacao_id" name="tipo_movimentacao_id">
                    @foreach ($tiposMovimentacao as $tipoMovimentacao)
                        <option value="{{ $tipoMovimentacao->tipo_movimentacao_id }}" {{ ($tipoMovimentacao->tipo_movimentacao_id == $t->tipo_movimentacao_id ? 'selected' : '') }}>{{ $tipoMovimentacao->tipo_movimentacao_descricao }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Data</label>
                    <input name="movimentacao_data" id="movimentacao_data" class="form-control" value="{{ date( 'd/m/Y' , strtotime($t->movimentacao_data)) }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Valor</label>
                    <input name="movimentacao_valor" class="form-control" value="{{ $t->movimentacao_valor }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Observação</label>
                    <input name="movimentacao_observacao" class="form-control" value="{{ $t->movimentacao_observacao }}" />
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Alterar
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExcluirModal">
        Excluir
    </button>
    <!-- Cadastrar Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar movimentação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração da movimentação?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Excluir Modal -->
    <div class="modal fade" id="ExcluirModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalExcluir"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir movimentação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão da movimentação?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('MovimentacaoController@excluiEntrada', $t->movimentacao_id)}}'">Sim</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
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