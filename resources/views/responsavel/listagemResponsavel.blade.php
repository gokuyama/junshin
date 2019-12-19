@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('responsaveis.novo')}}'">Adicionar Responsável</button>

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;" data-toggle="modal"
    data-target="#localizarModal">Localizar Responsável</button>

@if(is_null($listaResponsaveis))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($listaResponsaveis)==0)
<div class="alert alert-danger">
    Nenhum Responsável encontrado.
</div>

@else
<h1>Listagem de responsáveis</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-6">Nome do Responsável</th>
        <th class="col-5">Nome do Aluno</th>
        <th class="col-1">Ações</th>
    </tr>
    @foreach ($listaResponsaveis as $p)
    <tr class="d-flex">
        <td class="col-sm-6">{{$p->responsavel_nome}} </td>
        <td class="col-sm-5">{{$p->aluno_nome}} </td>
        <td class="col-sm-1"> <a href="{{action('ResponsavelController@edita', $p->responsavel_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>
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
<div class="modal fade" id="localizarModal" tabindex="-1" role="dialog" aria-labelledby="localizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="localizareModalLabel">Localizar Responsável</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{action('ResponsavelController@localiza')}}" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Responsável</label>
                        <input type="text" class="form-control" id="responsavel_nome_localiza"
                            name="responsavel_nome_localiza">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancela</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop