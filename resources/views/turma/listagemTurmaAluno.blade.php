@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-secondary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('TurmaController@lista')}}'">Voltar</button>

@if(count($alunosTurma)==0)
<div class="alert alert-danger">
    Nenhum aluno encontrado.
</div>

@else
<h1>Listagem de alunos da turma :{{$alunosTurma[0]->turma_descricao}}</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-11">Nome do Aluno</th>
        <th class="col-1">Editar</th>
    </tr>
    @foreach ($alunosTurma as $a)
    <tr class="d-flex">
        <td class="col-sm-11">{{$a->aluno_nome}} </td>
        <td class="col-sm-1"> <a href="{{action('AlunoController@edita', $a->aluno_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endif
@stop