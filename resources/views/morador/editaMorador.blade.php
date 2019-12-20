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

<h1>Editando o Morador: {{$m->morador_nome}} </h1>
<form action="{{action('MoradorController@altera',$m->morador_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Nome do Morador</label>
                    <input type="hidden" name="aluno_id" class="form-control" value="{{ $m->aluno_id }}" />
                    <input name="morador_nome" class="form-control" value="{{ $m->morador_nome }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Vínculo com o Aluno</label>
                    <input name="morador_vinculo" class="form-control" value="{{ $m->morador_vinculo }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input name="morador_data_nascimento" class="form-control" id="morador_data_nascimento"
                        value="{{ date( 'd/m/Y' , strtotime($m->morador_data_nascimento)) }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Sexo</label>
                    <select class="form-control" id="morador_sexo" name="morador_sexo">
                        <option value="">--</option>
                        <option value="M" {{ $m->morador_sexo == "M" ? 'selected' : '' }}>M</option>
                        <option value="F" {{ $m->morador_sexo == "F" ? 'selected' : '' }}>F</option>
                    </select>
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
        onclick="location.href='{{action('MoradorController@localizaMoradorPorAluno', $m->aluno_id)}}'">Voltar</button>

    <!-- Cadastrar Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar Morador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração do Morador?
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
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir Morador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão do Morador?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('MoradorController@exclui', $m->morador_id)}}'">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
jQuery(function($) {
    $("#morador_data_nascimento").mask("99/99/9999");
});
</script>
@stop