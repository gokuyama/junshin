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

<h1>Novo Morador</h1>
<form action="{{action('MoradorController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Nome do Morador</label>
                    <input type="hidden" name="aluno_id" class="form-control" value="{{ $alunos[0]->aluno_id }}" />
                    <input name="morador_nome" class="form-control" value="{{ old('morador_nome') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Vínculo com o Aluno</label>
                    <input name="morador_vinculo" class="form-control" value="{{ old('morador_vinculo') }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input name="morador_data_nascimento" class="form-control" id="morador_data_nascimento"
                        value="{{ old('morador_data_nascimento') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Sexo</label>
                    <select class="form-control" id="morador_sexo" name="morador_sexo">
                        <option value="">--</option>
                        <option value="M" {{ old('morador_sexo') == "M" ? 'selected' : '' }}>M</option>
                        <option value="F" {{ old('morador_sexo') == "F" ? 'selected' : '' }}>F</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Cadastrar
    </button>
    <button type="button" class="btn btn-secondary"
        onclick="location.href='{{action('MoradorController@localizaMoradorPorAluno',$alunos[0]->aluno_id)}}'">Voltar</button>

    <!-- Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Cadastrar Morador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma o cadastramento do Morador?
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
    $("#morador_data_nascimento").mask("99/99/9999");
});
</script>
@stop