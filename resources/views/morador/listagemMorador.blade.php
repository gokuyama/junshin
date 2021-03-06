@extends('layout.principal')
@section('conteudo')
<!--mostra a mensagem de sucesso -->
<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('MoradorController@novoMoradorPorAluno',$aluno_id)}}'">Adicionar
    Morador</button>
<button type="button" class="btn btn-secondary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('AlunoController@edita',$aluno_id)}}'">Voltar</button>

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
@stop