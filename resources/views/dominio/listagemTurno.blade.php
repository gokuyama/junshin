@extends('layout.principal')
@section('conteudo')

@if(empty($turnos))
<div class="alert alert-danger">
    Você não tem nenhum turno cadastrado.
</div>

@else
<h1>Listagem de turnos</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('turnos.novo')}}'">Adicionar Turnos</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Turnos</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($turnos as $t)
    <tr>
        <td class="col-sm-10">{{$t->turno_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('TurnoController@edita', $t->turno_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('$turno'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O tipo {{old('$turno')}} foi adicionado / alterado!
</div>
@endif

@stop