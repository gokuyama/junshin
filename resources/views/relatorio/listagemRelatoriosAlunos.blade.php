@extends('layout.principal')
@section('conteudo')


<h1>Relatórios do Aluno:{{$aluno->aluno_nome}} </h1>

<ul>
    <li><a href="{{action('RelatorioController@declaracaoMatricula',$aluno->aluno_id)}}"> Declaração de Matrícula </a>
    </li>
    <li><a href="{{action('RelatorioController@declaracaoAdimplencia',$aluno->aluno_id)}}"> Declaração de Adimplência
        </a>
    </li>
</ul>

<button type="button" class="btn btn-secondary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('TurmaController@lista')}}'">Voltar</button>

@stop