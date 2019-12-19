@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('alunos.novo')}}'">Adicionar Aluno</button>

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;" data-toggle="modal"
    data-target="#localizarModal">Localizar Aluno</button>

@if(is_null($alunos))
<div class="alert alert-primary">
    Bem Vindo! Selecione uma das opções acima.
</div>

@elseif(count($alunos)==0)
<div class="alert alert-danger">
    Nenhum aluno encontrado.
</div>

@else
<h1>Listagem de alunos</h1>
<table class="table table-striped table-bordered table-hover">
    <tr class="d-flex">
        <th class="col-8">Nome do Aluno</th>
        <th class="col-1">Editar</th>
        <th class="col-1">Matricula</th>
        <th class="col-1">Relatórios</th>
        <th class="col-1">Boletos</th>
    </tr>
    @foreach ($alunos as $p)
    <tr class="d-flex">
        <td class="col-sm-8">{{$p->aluno_nome}} </td>
        <td class="col-sm-1"> <a href="{{action('AlunoController@edita', $p->aluno_id)}}">
                <span class="fas fa-edit"></span>
            </a>
        </td>
        <td class="col-sm-1">
            <a style="padding-right: 15px;"
                href="{{action('MatriculaController@localizaMatriculaPorAluno', $p->aluno_id)}}">
                <span class="fas fa-search"></span>
            </a>
            <a href="{{action('MatriculaController@novaMatriculaPorAluno', $p->aluno_id)}}">
                <span class="fas fa-plus"></span>
            </a>
        </td>
        <td class="col-sm-1">
            <a href="{{action('RelatorioController@listaPorAluno', $p->aluno_id)}}">
                <span class="fas fa-file-pdf"></span>
        </td>
        <td class="col-sm-1">
            <a href="{{action('BoletoController@imprimeBoleto', $p->aluno_id)}}">
                <span class="fa fa-barcode"></span>
        </td>
        </a>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="localizareModalLabel">Localizar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{action('AlunoController@localiza')}}" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Aluno</label>
                        <input type="text" class="form-control" id="aluno_nome_localiza" name="aluno_nome_localiza">
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