@extends('layout.principal')
@section('conteudo')


<h1>Relatórios da Turma:{{$turma->turma_descricao}} </h1>

<ul>
    <li><a href="{{action('RelatorioController@listaChamada',$turma->turma_id)}}"> Lista de Chamada </a>
    </li>
    <li><a href="{{action('RelatorioController@contatoAlunos',$turma->turma_id)}}"> Contato dos Alunos </a>
    </li>
</ul>

<button type="button" class="btn btn-secondary" style="margin-bottom: 10px;" onclick="location.href='{{action('TurmaController@lista')}}'">Voltar</button>
@stop