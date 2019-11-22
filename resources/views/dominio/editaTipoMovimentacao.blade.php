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

<h1>Editando o tipo de movimentação: {{$t->tipo_movimentacao_descricao}}</h1>
<form action="{{action('TipoMovimentacaoController@altera',$t->tipo_movimentacao_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <label>Tipo</label>
                    <select class="form-control" id="tipo_movimentacao" name="tipo_movimentacao">
                        <option value="0" {{ ($t->tipo_movimentacao == 0 ? 'selected' : '') }}>Saída</option>
                        <option value="1" {{ ($t->tipo_movimentacao == 1 ? 'selected' : '') }}>Entrada</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <label>Descrição</label>
                    <input name="tipo_movimentacao_descricao" class="form-control" value="{{ $t->tipo_movimentacao_descricao }}" />
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
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar tipo de movimentação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração do tipo de movimentação?
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
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir tipo de movimentação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão do tipo de movimentação?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('TipoMovimentacaoController@exclui', $t->tipo_movimentacao_id)}}'">Sim</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>

@stop