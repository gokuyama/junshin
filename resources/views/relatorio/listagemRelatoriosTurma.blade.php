@extends('layout.principal')
@section('conteudo')


<h1>Relatórios da Turma:{{$turma->turma_descricao}} </h1>

<ul>
    <li><a href="{{action('RelatorioController@listaChamada',$turma->turma_id)}}"> Lista de Chamada </a>
    </li>
</ul>
@stop