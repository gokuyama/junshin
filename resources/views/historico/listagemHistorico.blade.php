@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('HistoricoController@novoHistoricoPorAluno',$aluno_id)}}'">Adicionar
    Histórico</button>

@if(is_null($listaHistoricos))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($listaHistoricos)==0)
<div class="alert alert-danger">
    Nenhum Histórico encontrado.
</div>

@else
<h1>Listagem de históricos de instituições do Aluno: {{$listaHistoricos[0]->aluno_nome}}</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-9">Nome da Instituição</th>
        <th class="col-1">Ano</th>
        <th class="col-1">Série</th>
        <th class="col-1">Ações</th>
    </tr>
    @foreach ($listaHistoricos as $h)
    <tr class="d-flex">
        <td class="col-sm-9">{{$h->historico_instituicao_nome}} </td>
        <td class="col-sm-1">{{$h->historico_instituicao_ano}} </td>
        <td class="col-sm-1">{{$h->historico_instituicao_serie}} </td>
        <td class="col-sm-1"> <a href="{{action('HistoricoController@edita', $h->historico_instituicao_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@stop