@extends('layout.principal')
@section('conteudo')

@if(empty($tiposTurma))
<div class="alert alert-danger">
    Você não tem nenhum tipo de turma cadastrado.
</div>

@else
<h1>Listagem de tipos de turma</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('tiposTurma.novo')}}'">Adicionar Tipo de turma</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Tipo de turma</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($tiposTurma as $t)
    <tr>
        <td class="col-sm-10">{{$t->tipo_turma_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('TipoTurmaController@edita', $t->tipo_turma_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
@stop