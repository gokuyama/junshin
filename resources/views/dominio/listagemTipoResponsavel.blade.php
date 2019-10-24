@extends('layout.principal')
@section('conteudo')

@if(empty($tiposResponsavel))
<div class="alert alert-danger">
    Você não tem nenhum tipo de responsável cadastrado.
</div>

@else
<h1>Listagem de tipos de responsável</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('tiposResponsavel.novo')}}'">Adicionar Tipo de Responsável</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Tipo de Responsável</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($tiposResponsavel as $t)
    <tr>
        <td class="col-sm-10">{{$t->tipo_responsavel_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('TipoResponsavelController@edita', $t->tipo_responsavel_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('tipo_responsavel_descricao'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O tipo {{old('tipo_responsavel_descricao')}} foi adicionado / alterado!
</div>
@endif

@stop