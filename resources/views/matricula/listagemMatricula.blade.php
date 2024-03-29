@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;" onclick="location.href='{{action('MatriculaController@novaMatriculaPorAluno',$aluno_id)}}'">Adicionar
    Matrícula</button>
<button type="button" class="btn btn-secondary" style="margin-bottom: 10px;" onclick="location.href='{{action('AlunoController@edita',$aluno_id)}}'">Voltar</button>

@if(is_null($listagemMatriculas))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($listagemMatriculas)==0)
<div class="alert alert-danger">
    Nenhuma Matrícula encontrada.
</div>

@else

<h1>Matrículas do Aluno:{{$listagemMatriculas[0]->aluno_nome}} </h1>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-7">Turma</th>
        <th class="col-2">Inicio</th>
        <th class="col-2">Fim</th>
        <th class="col-1">Ações</th>
    </tr>
    @foreach ($listagemMatriculas as $p)
    <tr class="{{ ($p->matricula_data_fim != null && $p->matricula_data_fim < date('Y-m-d H:i:s') || ($p->matricula_data_ini >= date('Y-m-d H:i:s'))) ? 'table table-dark' : ''}}">
        <td class="col-sm-7">{{$p->turma_descricao}} </td>
        <td class="col-sm-2">{{date( 'd/m/Y' , strtotime($p->matricula_data_ini))}} </td>
        @if($p->matricula_data_fim != null)
        <td class="col-sm-2"> {{date( 'd/m/Y' , strtotime($p->matricula_data_fim))}} </td>
        @else
        <td class="col-sm-2"> </td>
        @endif
        <td class="col-sm-1"> <a href="{{action('MatriculaController@edita', $p->matricula_id)}}">
                @if($p->matricula_data_fim == null || ($p->matricula_data_fim >= date('Y-m-d H:i:s') && $p->matricula_data_ini <= date('Y-m-d H:i:s'))) <span class="fas fa-edit"></span>
                    @else
                    <span class="fas fa-search"></span>
                    @endif
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