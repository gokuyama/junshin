@extends('layout.principal')
@section('conteudo')

@if(empty($niveisConhecimentoJapones))
<div class="alert alert-danger">
    Você não tem nenhum Nível de Conhecimento de Japonês cadastrado.
</div>

@else
<h1>Listagem de níveis de conhecimento de japonês</h1>
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('niveisConhecimentoJapones.novo')}}'">Adicionar Nível de Conhecimento de Japonês</button>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th class="col-10">Nível de Conhecimento de Japonês</th>
        <th class="col-2">Ações</th>
    </tr>
    @foreach ($niveisConhecimentoJapones as $n)
    <tr>
        <td class="col-sm-10">{{$n->nivel_conhecimento_japones_descricao}} </td>
        <td class="col-sm-2"> <a href="{{action('NivelConhecimentoJaponesController@edita', $n->nivel_conhecimento_japones_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>

    </tr>
    @endforeach
</table>
@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('nivel_conhecimento_japones_descricao'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O Nível de Conhecimento de Japonês {{old('nivel_conhecimento_japones_descricao')}} foi adicionado / alterado!
</div>
@endif

@stop