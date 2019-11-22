@extends('layout.principal')
@section('conteudo')

@if(empty($tipoMovimentacao))
<div class="alert alert-danger">
    Você não tem nenhum tipo de movimentação cadastrado.
</div>

@else
<h1>Tipos de movimentação</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('tiposMovimentacao.novo')}}'">Adicionar novo tipo de movimentação</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-2">Tipo</th>
        <th class="col-8">Descrição</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($tipoMovimentacao as $t)
    <tr>
        <td class="col-sm-2">{{ ($t->tipo_movimentacao == '0' ? 'Saída' : 'Entrada') }} </td>
        <td class="col-sm-8">{{$t->tipo_movimentacao_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('TipoMovimentacaoController@edita', $t->tipo_movimentacao_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('$tipoMovimentacao'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O tipo {{old('$tipoMovimentacao')}} foi adicionado / alterado!
</div>
@endif

@stop