@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('turmas.novo')}}'">Adicionar Turma</button>

@if(is_null($turmas))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($turmas)==0)
<div class="alert alert-danger">
    Nenhuma turma encontrada.
</div>

@else
<h1>Listagem de turmas</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-9">Nome da Turma</th>
        <th class="col-1">Editar</th>
        <th class="col-1">Lista Alunos</th>
        <th class="col-1">Relatórios</th>
    </tr>
    @foreach ($turmas as $t)
    <tr class="d-flex">
        <td class="col-sm-9">{{$t->turma_descricao}} </td>
        <td class="col-sm-1"> <a href="{{action('TurmaController@edita', $t->turma_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
        <td class="col-sm-1"> <a href="{{action('TurmaController@listaAlunos', $t->turma_id)}}">
                <span class="fas fa-search"></span>
            </a>
        </td>
        <td class="col-sm-1"> <a href="{{action('RelatorioController@listaPorTurma', $t->turma_id)}}">
                <span class="fas fa-file-pdf"></span>
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