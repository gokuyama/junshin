@extends('layout.principal')
@section('conteudo')

@if(empty($tiposDocumento))
<div class="alert alert-danger">
    Você não tem nenhum tipo de documento cadastrado.
</div>

@else
<h1>Listagem de tipos de documento</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('tiposDocumento.novo')}}'">Adicionar Tipo de Documento</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Tipo de Documento</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($tiposDocumento as $p)
    <tr>
        <td class="col-sm-10">{{$p->tipo_documento_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('TipoDocumentoController@edita', $p->tipo_documento_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
@stop