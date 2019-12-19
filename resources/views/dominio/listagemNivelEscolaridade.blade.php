@extends('layout.principal')
@section('conteudo')

@if(empty($niveisEscolaridade))
<div class="alert alert-danger">
    Você não tem nenhum nível de escolaridade cadastrado.
</div>

@else
<h1>Listagem de níveis de escolaridade</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('niveisEscolaridade.novo')}}'">Adicionar Nível de Escolaridade</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Nível de Escolaridade</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($niveisEscolaridade as $n)
    <tr>
        <td class="col-sm-10">{{$n->nivel_escolaridade_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('NivelEscolaridadeController@edita', $n->nivel_escolaridade_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
@stop