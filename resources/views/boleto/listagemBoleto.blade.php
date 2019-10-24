@extends('layout.principal')
@section('conteudo')

<h1>Geração de Boletos</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-1">Aluno</th>
        <th class="col-2">Respons.</th>
        <th class="col-2">endereço</th>
        <th class="col-1">bairro</th>
        <th class="col-1">cep</th>
        <th class="col-1">UF</th>
        <th class="col-1">cidade</th>
        <th class="col-2">documento</th>
        <th class="col-1">valor</th>
    </tr>
    @foreach ($listagemBoletos as $b)
    <tr class="d-flex">
        <td class="col-sm-1">{{$b->aluno_nome}}</td>
        <td class="col-sm-2">{{$b->nome_responsavel}}</td>
        <td class="col-sm-2">{{$b->endereco}}</td>
        <td class="col-sm-1">{{$b->bairro}}</td>
        <td class="col-sm-1">{{$b->cep}}</td>
        <td class="col-sm-1">{{$b->UF}}</td>
        <td class="col-sm-1">{{$b->cidade}}</td>
        <td class="col-sm-2">{{$b->documento}}</td>
        <td class="col-sm-1">{{$b->valor}}</td>
    </tr>
    @endforeach
</table>
@stop