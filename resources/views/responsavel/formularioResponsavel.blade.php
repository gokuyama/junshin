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

<h1>Novo Responsável</h1>
<form action="{{action('ResponsavelController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Tipo de Responsável</label>
                    <select class="form-control" id="tipo_responsavel_id" name="tipo_responsavel_id">
                        <option value="">--</option>
                        @foreach ($tiposResponsavel as $tipoResponsavel)
                        <option value="{{ $tipoResponsavel->tipo_responsavel_id }}" {{ ($tipoResponsavel->tipo_responsavel_id == old('tipo_responsavel_id') ? 'selected="selected"' : '') }}>
                            {{ $tipoResponsavel->tipo_responsavel_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-10">
                <div class="form-group">
                    <label>Responsável do Aluno</label>
                    @if (count($alunos) > 1)
                    <select class="form-control" id="aluno_id" name="aluno_id">
                        <option value="">--</option>
                        @foreach ($alunos as $aluno)
                        <option value="{{ $aluno->aluno_id }}" {{ ($aluno->aluno_id == old('aluno_id') ? 'selected="selected"' : '') }}>
                            {{ $aluno->aluno_nome }}</option>
                        @endforeach
                    </select>
                    @else
                    @foreach ($alunos as $aluno)
                    <input type="hidden" name="aluno_id" class="form-control" value="{{ $aluno->aluno_id }}" />
                    <input name="aluno_nome" class="form-control" value="{{ $aluno->aluno_nome }}" disabled />
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Nome do Responsável</label>
                    <input name="responsavel_nome" class="form-control" value="{{ old('responsavel_nome') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>CPF</label>
                    <input id="cpf" name="pagador_cpf" class="form-control" value="{{ old('pagador_cpf') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>% Pgto Mensalidade</label>
                    <input name="pagador_percentual" class="form-control" value="{{ old('pagador_percentual') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Firma</label>
                    <input name="responsavel_firma" class="form-control" value="{{ old('responsavel_firma') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Telefone da Firma</label>
                    <input name="responsavel_telefone_firma" class="form-control telefoneFixo" value="{{ old('responsavel_telefone_firma') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Ramal da Firma</label>
                    <input name="responsavel_ramal_firma" class="form-control" value="{{ old('responsavel_ramal_firma') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Profissão</label>
                    <input name="responsavel_profissao" class="form-control" value="{{ old('responsavel_profissao') }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Estado Civil</label>
                    <select class="form-control" id="responsavel_estado_civil_id" name="responsavel_estado_civil_id">
                        <option value="">--</option>
                        @foreach ($estadosCivil as $estadoCivil)
                        <option value="{{ $estadoCivil->estado_civil_id }}" {{ ($estadoCivil->estado_civil_id == old('responsavel_estado_civil_id') ? 'selected="selected"' : '') }}>
                            {{ $estadoCivil->estado_civil_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Celular</label>
                    <input name="responsavel_celular" class="form-control telefoneCelular" value="{{ old('responsavel_celular') }}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>e-mail</label>
                    <input name="responsavel_email" class="form-control" value="{{ old('responsavel_email') }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Nacionalidade</label>
                    <input name="responsavel_nascionalidade" class="form-control" value="{{ old('responsavel_nascionalidade') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input name="responsavel_data_nascimento" class="form-control" id="responsavel_data_nascimento" value="{{ old('responsavel_data_nascimento') }}" />
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Geração</label>
                    <input name="responsavel_ordem_geracao" class="form-control" value="{{ old('responsavel_ordem_geracao') }}" />
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Religião</label>
                    <input name="responsavel_religiao" class="form-control" value="{{ old('responsavel_religiao') }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Escolaridade</label>
                    <select class="form-control" id="nivel_escolaridade_id" name="nivel_escolaridade_id">
                        <option value="">--</option>
                        @foreach ($niveisEscolaridade as $nivelEscolaridade)
                        <option value="{{ $nivelEscolaridade->nivel_escolaridade_id }}" {{ ($nivelEscolaridade->nivel_escolaridade_id == old('nivel_escolaridade_id') ? 'selected="selected"' : '') }}>
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
                    <input name="pagador_rua" class="form-control" value="{{ old('pagador_rua') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Número</label>
                    <input name="pagador_numero" class="form-control" value="{{ old('pagador_numero') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Complemento</label>
                    <input name="pagador_complemento" class="form-control" value="{{ old('pagador_complemento') }}" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Bairro</label>
                    <input name="pagador_bairro" class="form-control" value="{{ old('pagador_bairro') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>CEP</label>
                    <input name="pagador_cep" class="form-control" value="{{ old('pagador_cep') }}" id="cep" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Cidade</label>
                    <input name="pagador_cidade" class="form-control" value="{{ old('pagador_cidade') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control" id="pagador_estado" name="pagador_estado">
                        <option value="AC" {{ old('pagador_estado') == "AC" ? 'selected' : ''}}>AC</option>
                        <option value="AL" {{ old('pagador_estado') == "AL" ? 'selected' : ''}}>AL</option>
                        <option value="AP" {{ old('pagador_estado') == "AP" ? 'selected' : ''}}>AP</option>
                        <option value="AM" {{ old('pagador_estado') == "AM" ? 'selected' : ''}}>AM</option>
                        <option value="BA" {{ old('pagador_estado') == "BA" ? 'selected' : ''}}>BA</option>
                        <option value="CE" {{ old('pagador_estado') == "CE" ? 'selected' : ''}}>CE</option>
                        <option value="DF" {{ old('pagador_estado') == "DF" ? 'selected' : ''}}>DF</option>
                        <option value="ES" {{ old('pagador_estado') == "ES" ? 'selected' : ''}}>ES</option>
                        <option value="GO" {{ old('pagador_estado') == "GO" ? 'selected' : ''}}>GO</option>
                        <option value="MA" {{ old('pagador_estado') == "MA" ? 'selected' : ''}}>MA</option>
                        <option value="MT" {{ old('pagador_estado') == "MT" ? 'selected' : ''}}>MT</option>
                        <option value="MS" {{ old('pagador_estado') == "MS" ? 'selected' : ''}}>MS</option>
                        <option value="MG" {{ old('pagador_estado') == "MG" ? 'selected' : ''}}>MG</option>
                        <option value="PA" {{ old('pagador_estado') == "PA" ? 'selected' : ''}}>PA</option>
                        <option value="PB" {{ old('pagador_estado') == "PB" ? 'selected' : ''}}>PB</option>
                        <option value="PR" {{ old('pagador_estado') == "PR" ? 'selected' : ''}}>PR</option>
                        <option value="PE" {{ old('pagador_estado') == "PE" ? 'selected' : ''}}>PE</option>
                        <option value="PI" {{ old('pagador_estado') == "PI" ? 'selected' : ''}}>PI</option>
                        <option value="RJ" {{ old('pagador_estado') == "RJ" ? 'selected' : ''}}>RJ</option>
                        <option value="RN" {{ old('pagador_estado') == "RN" ? 'selected' : ''}}>RN</option>
                        <option value="RS" {{ old('pagador_estado') == "RS" ? 'selected' : ''}}>RS</option>
                        <option value="RO" {{ old('pagador_estado') == "RO" ? 'selected' : ''}}>RO</option>
                        <option value="RR" {{ old('pagador_estado') == "RR" ? 'selected' : ''}}>RR</option>
                        <option value="SC" {{ old('pagador_estado') == "SC" ? 'selected' : ''}}>SC</option>
                        <option value="SP" {{ old('pagador_estado') == "SP" ? 'selected' : ''}}>SP</option>
                        <option value="SE" {{ old('pagador_estado') == "SE" ? 'selected' : ''}}>SE</option>
                        <option value="TO" {{ old('pagador_estado') == "TO" ? 'selected' : ''}}>TO</option>
                    </select>
                </div>
            </div>
        </div>

    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Cadastrar
    </button>
    <button type="button" class="btn btn-secondary" onclick="location.href='{{action('ResponsavelController@localizaResponsavelPorAluno', $alunos[0]->aluno_id)}}'">Voltar</button>


    <!-- Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Cadastrar responsável</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma o cadastramento do responsável?
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
        $("#responsavel_data_nascimento").mask("99/99/9999");
        $('.telefoneCelular').mask('(00) 00000-0000');
        $('.telefoneFixo').mask('(00) 0000-0000');
        $('#cpf').mask('000.000.000-00');
        $('#cep').mask('00.000-000');
    });
</script>
@stop