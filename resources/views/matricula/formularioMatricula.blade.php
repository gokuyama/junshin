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

<h1>Nova Matrícula</h1>
<form action="{{action('MatriculaController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Aluno</label>
                    @if (count($alunos) > 1)
                    <select class="form-control" id="aluno_id" name="aluno_id">
                        <option value="">--</option>
                        @foreach ($alunos as $aluno)
                        <option value="{{ $aluno->aluno_id }}"
                            {{ ($aluno->aluno_id == old('aluno_id') ? 'selected="selected"' : '') }}>
                            {{ $aluno->aluno_nome }}</option>
                        @endforeach
                    </select>
                    @else
                    <input type="hidden" name="aluno_id" class="form-control" value="{{ $alunos[0]->aluno_id }}" />
                    <input name="aluno_nome" class="form-control" value="{{ $alunos[0]->aluno_nome }}" disabled />
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Turma</label>
                    <select class="form-control" id="turma_id" name="turma_id">
                        <option value="">--</option>
                        @foreach ($turmas as $turma)
                        <option value="{{ $turma->turma_id }}"
                            {{ ($turma->turma_id == old('turma_id') ? 'selected="selected"' : '') }}>
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
                        value="{{ old('matricula_data_ini') }}" />
                    <input type="hidden" name="mensalidade_data_ini" class="form-control mask-date" id="mensalidade_data_ini"
                        value="{{ old('mensalidade_data_ini') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Mensalidade R$</label>
                    <input name="mensalidade_valor" class="form-control money" value="{{ old('mensalidade_valor') }}" />
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Cadastrar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Cadastrar Matrícula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma o cadastramento da Matrícula?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
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
$('#matricula_data_ini').keyup(function (){
    $('#mensalidade_data_ini').val($(this).val()); // <-- reverse your selectors here
});
</script>
@stop