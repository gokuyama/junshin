@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('movimentacoes.nova.saida')}}'">Adicionar nova saída</button>

@if(empty($movimentacao))
<div class="alert alert-danger">
    Você não tem nenhuma movimentação cadastrada.
</div>

@else
<h1>Saídas</h1>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-2">Data</th>
        <th class="col-2">Tipo</th>
        <th class="col-2">Descrição</th>
        <th class="col-2">Valor</th>
        <th class="col-2">Observação</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($movimentacao as $t)
    <tr>
        <td class="col-sm-2">{{$t->movimentacao_data}} </td>
        <td class="col-sm-2">{{ ($t->tipo_movimentacao == '0' ? 'Saída' : 'Entrada') }} </td>
        <td class="col-sm-2">{{$t->tipo_movimentacao_descricao}} </td>
        <td class="col-sm-2">{{$t->movimentacao_valor}} </td>
        <td class="col-sm-2">{{$t->movimentacao_observacao}} </td>
        <td class="col-sm-2"> <a href="{{action('MovimentacaoController@editaSaida', $t->movimentacao_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>

<div class="row">
  <div class="col-12 d-flex justify-content-center">
    {{ $movimentacao->links() }}  
  </div>
</div>

@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('$movimentacao'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O tipo {{old('$Movimentacao')}} foi adicionado / alterado!
</div>
@endif

@stop