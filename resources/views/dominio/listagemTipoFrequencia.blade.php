@extends('layout.principal')
@section('conteudo')

@if(empty($tiposFrequencia))
<div class="alert alert-danger">
    Você não tem nenhum tipo de frequência cadastrado.
</div>

@else
<h1>Listagem de tipos de frequência</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('tiposFrequencia.novo')}}'">Adicionar Tipo de Frequência</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Tipo de frequência</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($tiposFrequencia as $t)
    <tr>
        <td class="col-sm-10">{{$t->tipos_frequencia_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('TipoFrequenciaController@edita', $t->tipo_frequencia_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
@stop