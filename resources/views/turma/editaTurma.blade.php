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

<h1>Editando a Turma: {{$t->turma_descricao}} </h1>
<form action="{{action('TurmaController@altera',$t->turma_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Descrição da Turma</label>
                    <input name="turma_descricao" class="form-control" value="{{ $t->turma_descricao }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Tipo da Turma</label>
                    <select class="form-control" id="tipo_turma_id" name="tipo_turma_id">
                        <option value="">--</option>
                        @foreach ($tiposTurma as $tipoTurma)
                        <option value="{{ $tipoTurma->tipo_turma_id }}"
                            {{ ($tipoTurma->tipo_turma_id ==  $t->tipo_turma_id ? 'selected="selected"' : '') }}>
                            {{ $tipoTurma->tipo_turma_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Turno</label>
                    <select class="form-control" id="turno_id" name="turno_id">
                        <option value="">--</option>
                        @foreach ($turnos as $turno)
                        <option value="{{ $turno->turno_id }}"
                            {{ ($turno->turno_id == $t->turno_id ? 'selected="selected"' : '') }}>
                            {{ $turno->turno_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Tipo de Frequência</label>
                    <select class="form-control" id="tipo_frequencia_id" name="tipo_frequencia_id">
                        <option value="">--</option>
                        @foreach ($tiposFrequencia as $tipoFrequencia)
                        <option value="{{ $tipoFrequencia->tipo_frequencia_id }}"
                            {{ ($tipoFrequencia->tipo_frequencia_id == $t->tipo_frequencia_id ? 'selected="selected"' : '') }}>
                            {{ $tipoFrequencia->tipos_frequencia_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Observação</label>
                    <input name="turma_observacao" class="form-control" value="{{ $t->turma_observacao }}" />
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
    <button type="button" class="btn btn-secondary"
        onclick="location.href='{{action('TurmaController@lista')}}'">Voltar</button>

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
                    Confirma a exclus��o da Turma?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('TurmaController@exclui', $t->turma_id)}}'">Sim</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>
@stop