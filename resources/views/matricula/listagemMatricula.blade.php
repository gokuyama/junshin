@extends('layout.principal')
@section('conteudo')

@if(is_null($listagemMatriculas))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($listagemMatriculas)==0)
<div class="alert alert-danger">
    Nenhum Matrícula encontrado.
</div>

@else
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('MatriculaController@novaMatriculaPorAluno',$aluno_id)}}'">Adicionar
    Matrícula</button>

<h1>Matrículas do Aluno:{{$listagemMatriculas[0]->aluno_nome}} </h1>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-7">Turma</th>
        <th class="col-2">Inicio</th>
        <th class="col-2">Fim</th>
        <th class="col-1">Ações</th>
    </tr>
    @foreach ($listagemMatriculas as $p)
    <tr class="{{ $p->matricula_data_fim <= date('Y-m-d H:i:s') ? 'table table-dark' : ''}}">
        <td class="col-sm-7">{{$p->turma_descricao}} </td>
        <td class="col-sm-2">{{date( 'd/m/Y' , strtotime($p->matricula_data_ini))}} </td>
        <td class="col-sm-2">
            {{$p->matricula_data_fim < date('Y-12-31') ? date( 'd/m/Y' , strtotime($p->matricula_data_fim)) : '' }}
        </td>
        <td class="col-sm-1"> <a href="{{action('MatriculaController@edita', $p->matricula_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('responsavel_nome'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O Matrícula foi alterada!
</div>
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