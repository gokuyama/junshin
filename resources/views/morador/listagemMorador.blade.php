@extends('layout.principal')
@section('conteudo')
<!--mostra a mensagem de sucesso -->
@if(!is_null($mensagemOk))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    {{ $mensagemOk }}
</div>
@endif
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('MoradorController@novoMoradorPorAluno',$aluno_id)}}'">Adicionar
    Morador</button>

@if(is_null($listaMoradores))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($listaMoradores)==0)
<div class="alert alert-danger">
    Nenhum Morador encontrado.
</div>

@else
<h1>Listagem de moradores do Aluno: {{$listaMoradores[0]->aluno_nome}}</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-11">Nome do Morador</th>
        <th class="col-1">Ações</th>
    </tr>
    @foreach ($listaMoradores as $m)
    <tr class="d-flex">
        <td class="col-sm-11">{{$m->morador_nome}} </td>
        <td class="col-sm-1"> <a href="{{action('MoradorController@edita', $m->morador_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endif
<!--mostra a mensagem de sucesso em caso de inserção-->
@if(old('morador_nome'))
<div class="alert alert-success">
    <strong>Sucesso!</strong>
    O Morador {{old('morador_nome')}} foi adicionado / alterado!
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