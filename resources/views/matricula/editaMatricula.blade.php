@extends('layout.principal')
@section('conteudo')
<!--mensagens de erro-->
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1>Editando a Matrícula do Aluno: {{$listagemMatriculas->aluno_nome}} </h1>
<form action="{{action('MatriculaController@altera',$listagemMatriculas->matricula_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Aluno</label>
                    <input type="hidden" name="aluno_id" class="form-control"
                        value="{{  $listagemMatriculas->aluno_id }}" />
                    <input name="aluno_nome" class="form-control" value="{{ $listagemMatriculas->aluno_nome }}"
                        disabled />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Turma</label>
                    <select class="form-control" id="turma_id" name="turma_id">
                        <option value="">--</option>
                        @foreach ($turmas as $turma)
                        <option value="{{ $turma->turma_id }}"
                            {{ ($turma->turma_id == $listagemMatriculas->turma_id ? 'selected="selected"' : '') }}>
                            {{ $turma->turma_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Data Inicio</label>
                    <input name="matricula_data_ini" class="form-control mask-date" id="matricula_data_ini"
                        value="{{ date( 'd/m/Y' , strtotime($listagemMatriculas->matricula_data_ini)) }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Data Fim</label>
                    <input name="matricula_data_fim" class="form-control mask-date"
                        value="{{ date( 'd/m/Y' , strtotime($listagemMatriculas->matricula_data_fim)) }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Mensalidade R$</label>
                    <input name="mensalidade_valor" class="form-control money" value="{{ $mensalidade->mensalidade_valor }}" />
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Alterar
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExcluirModal">
        Excluir
    </button>

    <!-- Cadastrar Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar Turma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração da Turma?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Excluir Modal -->
    <div class="modal fade" id="ExcluirModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalExcluir"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir Turma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão da Matrícula?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('MatriculaController@exclui', $listagemMatriculas->matricula_id)}}'">Sim</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
jQuery(function($) {
    $(".mask-date").mask("99/99/9999");
    $(".money").mask("#.##0,00", {
        reverse: true
    });
});
</script>
@stop