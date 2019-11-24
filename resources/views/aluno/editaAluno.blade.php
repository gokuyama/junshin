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

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('MatriculaController@localizaMatriculaPorAluno', $a->aluno_id)}}'">Matrícula</button>

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('ResponsavelController@localizaResponsavelPorAluno', $a->aluno_id)}}'">Responsáveis</button>

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('MoradorController@localizaMoradorPorAluno', $a->aluno_id)}}'">Moradores</button>

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{action('HistoricoController@localizaHistoricoPorAluno', $a->aluno_id)}}'">Histórico
    Instituições</button>

<h1>Editando o Aluno: {{$a->aluno_nome}} </h1>

<form action="{{action('AlunoController@altera',$a->aluno_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <label>Nome do Aluno</label>
                    <input name="aluno_nome" class="form-control" value="{{ $a->aluno_nome }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Código do Aluno</label>
                    <input name="aluno_codigo" class="form-control" value="{{ $a->aluno_codigo }}" />
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input name="aluno_data_nascimento" class="form-control" id="aluno_data_nascimento"
                        value="{{ date( 'd/m/Y' , strtotime($a->aluno_data_nascimento)) }}" />
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label>Local de Nascimento</label>
                    <input name="aluno_local_nascimento" class="form-control"
                        value="{{ $a->aluno_local_nascimento }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Tipo de Documento</label>
                    <select class="form-control" id="tipo_documento_id" name="tipo_documento_id">
                        <option value="">--</option>
                        @foreach ($tiposDocumento as $tipoDocumento)
                        <option value="{{ $tipoDocumento->tipo_documento_id }}"
                            {{ ($tipoDocumento->tipo_documento_id == $a->tipo_documento_id ? 'selected="selected"' : '') }}>
                            {{ $tipoDocumento->tipo_documento_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Número do Documento</label>
                    <input name="aluno_documento" class="form-control" value="{{ $a->aluno_documento }}" />
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Sexo</label>
                    <select class="form-control" id="aluno_sexo" name="aluno_sexo">
                        <option value="">--</option>
                        <option value="M" {{ $a->aluno_sexo == "M" ? 'selected' : '' }}>M</option>
                        <option value="F" {{ $a->aluno_sexo == "F" ? 'selected' : '' }}>F</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Escolaridade</label>
                    <select class="form-control" id="nivel_escolaridade_id" name="nivel_escolaridade_id">
                        <option value="">--</option>
                        @foreach ($niveisEscolaridade as $nivelEscolaridade)
                        <option value="{{ $nivelEscolaridade->nivel_escolaridade_id }}"
                            {{ ($nivelEscolaridade->nivel_escolaridade_id == $a->nivel_escolaridade_id ? 'selected="selected"' : '') }}>
                            {{ $nivelEscolaridade->nivel_escolaridade_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <label>Endereço</label>
                    <input name="aluno_endereco_rua" class="form-control" value="{{ $a->aluno_endereco_rua }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Número</label>
                    <input name="aluno_endereco_numero" class="form-control" value="{{ $a->aluno_endereco_numero }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Complemento</label>
                    <input name="aluno_endereco_complemento" class="form-control"
                        value="{{ $a->aluno_endereco_complemento }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Bairro</label>
                    <input name="aluno_endereco_bairro" class="form-control" value="{{ $a->aluno_endereco_bairro }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>CEP</label>
                    <input name="aluno_endereco_cep" class="form-control" id="cep"
                        value="{{ $a->aluno_endereco_cep }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Cidade</label>
                    <input name="aluno_endereco_cidade" class="form-control" value="{{ $a->aluno_endereco_cidade }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control" id="aluno_endereco_estado" name="aluno_endereco_estado">
                        <option value="--">--</option>
                        <option value="AC" {{$a->aluno_endereco_estado == "AC" ? 'selected' : ''}}>AC</option>
                        <option value="AL" {{$a->aluno_endereco_estado == "AL" ? 'selected' : ''}}>AL</option>
                        <option value="AP" {{$a->aluno_endereco_estado == "AP" ? 'selected' : ''}}>AP</option>
                        <option value="AM" {{$a->aluno_endereco_estado == "AM" ? 'selected' : ''}}>AM</option>
                        <option value="BA" {{$a->aluno_endereco_estado == "BA" ? 'selected' : ''}}>BA</option>
                        <option value="CE" {{$a->aluno_endereco_estado == "CE" ? 'selected' : ''}}>CE</option>
                        <option value="DF" {{$a->aluno_endereco_estado == "DF" ? 'selected' : ''}}>DF</option>
                        <option value="ES" {{$a->aluno_endereco_estado == "ES" ? 'selected' : ''}}>ES</option>
                        <option value="GO" {{$a->aluno_endereco_estado == "GO" ? 'selected' : ''}}>GO</option>
                        <option value="MA" {{$a->aluno_endereco_estado == "MA" ? 'selected' : ''}}>MA</option>
                        <option value="MT" {{$a->aluno_endereco_estado == "MT" ? 'selected' : ''}}>MT</option>
                        <option value="MS" {{$a->aluno_endereco_estado == "MS" ? 'selected' : ''}}>MS</option>
                        <option value="MG" {{$a->aluno_endereco_estado == "MG" ? 'selected' : ''}}>MG</option>
                        <option value="PA" {{$a->aluno_endereco_estado == "PA" ? 'selected' : ''}}>PA</option>
                        <option value="PB" {{$a->aluno_endereco_estado == "PB" ? 'selected' : ''}}>PB</option>
                        <option value="PR" {{$a->aluno_endereco_estado == "PR" ? 'selected' : ''}}>PR</option>
                        <option value="PE" {{$a->aluno_endereco_estado == "PE" ? 'selected' : ''}}>PE</option>
                        <option value="PI" {{$a->aluno_endereco_estado == "PI" ? 'selected' : ''}}>PI</option>
                        <option value="RJ" {{$a->aluno_endereco_estado == "RJ" ? 'selected' : ''}}>RJ</option>
                        <option value="RN" {{$a->aluno_endereco_estado == "RN" ? 'selected' : ''}}>RN</option>
                        <option value="RS" {{$a->aluno_endereco_estado == "RS" ? 'selected' : ''}}>RS</option>
                        <option value="RO" {{$a->aluno_endereco_estado == "RO" ? 'selected' : ''}}>RO</option>
                        <option value="RR" {{$a->aluno_endereco_estado == "RR" ? 'selected' : ''}}>RR</option>
                        <option value="SC" {{$a->aluno_endereco_estado == "SC" ? 'selected' : ''}}>SC</option>
                        <option value="SP" {{$a->aluno_endereco_estado == "SP" ? 'selected' : ''}}>SP</option>
                        <option value="SE" {{$a->aluno_endereco_estado == "SE" ? 'selected' : ''}}>SE</option>
                        <option value="TO" {{$a->aluno_endereco_estado == "TO" ? 'selected' : ''}}>TO</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Telefone Fixo</label>
                    <input name="aluno_telefone_fixo" class="form-control telefoneFixo"
                        value="{{ $a->aluno_telefone_fixo }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Celular</label>
                    <input name="aluno_telefone_celular" class="form-control telefoneCelular"
                        value="{{ $a->aluno_telefone_celular }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Telefone para recado</label>
                    <input name="aluno_telefone_recado" class="form-control telefoneCelular"
                        value="{{ $a->aluno_telefone_recado }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Religião</label>
                    <input name="aluno_religiao" class="form-control" value="{{ $a->aluno_religiao }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>e-mail</label>
                    <input name="aluno_email" class="form-control" value="{{ $a->aluno_email }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Observação</label>
                    <input name="aluno_observacao" class="form-control" value="{{ $a->aluno_observacao }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Nº de irmãos</label>
                    <input name="aluno_quantidade_irmaos" class="form-control"
                        value="{{ $a->aluno_quantidade_irmaos }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Ordem de nascimento</label>
                    <input name="aluno_ordem_nascimento" class="form-control"
                        value="{{ $a->aluno_ordem_nascimento }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Geração</label>
                    <input name="aluno_ordem_geracao" class="form-control" value="{{ $a->aluno_ordem_geracao }}" />
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Nível de conhecimento de japonês</label>
                    <select class="form-control" id="nivel_conhecimento_japones_id"
                        name="nivel_conhecimento_japones_id">
                        <option value="">--</option>
                        @foreach ($niveisConhecimentoJapones as $nivelConhecimentoJapones)
                        <option value="{{ $nivelConhecimentoJapones->nivel_conhecimento_japones_id }}"
                            {{ ($nivelConhecimentoJapones->nivel_conhecimento_japones_id == $a->nivel_conhecimento_japones_id ? 'selected="selected"' : '') }}>
                            {{ $nivelConhecimentoJapones->nivel_conhecimento_japones_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Aluno vacinado?</label>
                    <select class="form-control" id="aluno_vacinado" name="aluno_vacinado">
                        <option value="">--</option>
                        <option value=1 {{ $a->aluno_vacinado == 1 ? 'selected' : '' }}>Sim</option>
                        <option value=0 {{ $a->aluno_vacinado == 0 ? 'selected' : '' }}>Não</option>
                    </select>
                </div>
            </div>
            <div class="col-10">
                <div class="form-group">
                    <label>Observação (Vacina)</label>
                    <input name="aluno_vacinado_observacao" class="form-control"
                        value="{{ $a->aluno_vacinado_observacao }}" />
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
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar Aluno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração do Aluno?
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
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir Aluno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão do Aluno?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('AlunoController@exclui', $a->aluno_id)}}'">Sim</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
jQuery(function($) {
    $("#aluno_data_nascimento").mask("99/99/9999");
    $("#cep").mask("99999-999");
    $('.telefoneCelular').mask('(00) 00000-0000');
    $('.telefoneFixo').mask('(00) 0000-0000');
});
</script>
@stop