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

<h1>Editando o Responsável: {{$r->responsavel_nome}} </h1>
<form action="{{action('ResponsavelController@altera',$r->responsavel_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Tipo de Responsável</label>
                    <select class="form-control" id="tipo_responsavel_id" name="tipo_responsavel_id">
                        <option value="">--</option>
                        @foreach ($tiposResponsavel as $tipoResponsavel)
                        <option value="{{ $tipoResponsavel->tipo_responsavel_id }}" {{ ($tipoResponsavel->tipo_responsavel_id == $r->tipo_responsavel_id ? 'selected="selected"' : '') }}>
                            {{ $tipoResponsavel->tipo_responsavel_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-10">
                <div class="form-group">
                    <label>Responsável do Aluno</label>
                    <input type="hidden" name="aluno_id" class="form-control" value="{{ $aluno->aluno_id }}" />
                    <input name="aluno_nome" class="form-control" value="{{ $aluno->aluno_nome }}" disabled />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Nome do Responsável</label>
                    <input name="responsavel_nome" class="form-control" value="{{ $r->responsavel_nome }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>CPF</label>
                    <input name="pagador_cpf" class="form-control" id="cpf" value="{{ $pagadores[0]->pagador_cpf }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>% Pgto Mensalidade</label>
                    <input name="pagador_percentual" class="form-control" value="{{ $pagadores[0]->pagador_percentual }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Firma</label>
                    <input name="responsavel_firma" class="form-control" value="{{ $r->responsavel_firma }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Telefone da Firma</label>
                    <input name="responsavel_telefone_firma" class="form-control" value="{{ $r->responsavel_telefone_firma }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Ramal da Firma</label>
                    <input name="responsavel_ramal_firma" class="form-control" value="{{ $r->responsavel_ramal_firma }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Profissão</label>
                    <input name="responsavel_profissao" class="form-control" value="{{ $r->responsavel_profissao }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Estado Civil</label>
                    <select class="form-control" id="responsavel_estado_civil_id" name="responsavel_estado_civil_id">
                        <option value="">--</option>
                        @foreach ($estadosCivil as $estadoCivil)
                        <option value="{{ $estadoCivil->estado_civil_id }}" {{ ($estadoCivil->estado_civil_id == $r->responsavel_estado_civil_id ? 'selected="selected"' : '') }}>
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
                    <input name="responsavel_celular" class="form-control" value="{{ $r->responsavel_celular }}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>e-mail</label>
                    <input name="responsavel_email" class="form-control" value="{{ $r->responsavel_email }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Nacionalidade</label>
                    <input name="responsavel_nascionalidade" class="form-control" value="{{ $r->responsavel_nascionalidade }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    @if($r->responsavel_data_nascimento == '--')
                    <input name="responsavel_data_nascimento" class="form-control" id="responsavel_data_nascimento" />
                    @else
                    <input name="responsavel_data_nascimento" class="form-control" id="responsavel_data_nascimento" value="{{ date( 'd/m/Y' , strtotime($r->responsavel_data_nascimento)) }}" />
                    @endif
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Geração</label>
                    <input name="responsavel_ordem_geracao" class="form-control" value="{{ $r->responsavel_ordem_geracao }}" />
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Religião</label>
                    <input name="responsavel_religiao" class="form-control" value="{{ $r->responsavel_religiao }}" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Escolaridade</label>
                    <select class="form-control" id="responsavel_escolaridade_id" name="responsavel_escolaridade_id">
                        <option value="">--</option>
                        @foreach ($niveisEscolaridade as $nivelEscolaridade)
                        <option value="{{ $nivelEscolaridade->nivel_escolaridade_id }}" {{ ($nivelEscolaridade->nivel_escolaridade_id == $r->responsavel_escolaridade_id ? 'selected="selected"' : '') }}>
                            {{ $nivelEscolaridade->nivel_escolaridade_descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @if (count($pagadores) > 0)
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <label>Endereço</label>
                    <input name="pagador_rua" class="form-control" value="{{ $pagadores[0]->pagador_rua }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Número</label>
                    <input name="pagador_numero" class="form-control" value="{{ $pagadores[0]->pagador_numero }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Complemento</label>
                    <input name="pagador_complemento" class="form-control" value="{{ $pagadores[0]->pagador_complemento }}" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Bairro</label>
                    <input name="pagador_bairro" class="form-control" value="{{ $pagadores[0]->pagador_bairro }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>CEP</label>
                    <input name="pagador_cep" class="form-control" value="{{ $pagadores[0]->pagador_cep }}" id="cep" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Cidade</label>
                    <input name="pagador_cidade" class="form-control" value="{{ $pagadores[0]->pagador_cidade }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control" id="pagador_estado" name="pagador_estado">
                        <option value="AC" {{$pagadores[0]->pagador_estado == "AC" ? 'selected' : ''}}>AC</option>
                        <option value="AL" {{$pagadores[0]->pagador_estado == "AL" ? 'selected' : ''}}>AL</option>
                        <option value="AP" {{$pagadores[0]->pagador_estado == "AP" ? 'selected' : ''}}>AP</option>
                        <option value="AM" {{$pagadores[0]->pagador_estado == "AM" ? 'selected' : ''}}>AM</option>
                        <option value="BA" {{$pagadores[0]->pagador_estado == "BA" ? 'selected' : ''}}>BA</option>
                        <option value="CE" {{$pagadores[0]->pagador_estado == "CE" ? 'selected' : ''}}>CE</option>
                        <option value="DF" {{$pagadores[0]->pagador_estado == "DF" ? 'selected' : ''}}>DF</option>
                        <option value="ES" {{$pagadores[0]->pagador_estado == "ES" ? 'selected' : ''}}>ES</option>
                        <option value="GO" {{$pagadores[0]->pagador_estado == "GO" ? 'selected' : ''}}>GO</option>
                        <option value="MA" {{$pagadores[0]->pagador_estado == "MA" ? 'selected' : ''}}>MA</option>
                        <option value="MT" {{$pagadores[0]->pagador_estado == "MT" ? 'selected' : ''}}>MT</option>
                        <option value="MS" {{$pagadores[0]->pagador_estado == "MS" ? 'selected' : ''}}>MS</option>
                        <option value="MG" {{$pagadores[0]->pagador_estado == "MG" ? 'selected' : ''}}>MG</option>
                        <option value="PA" {{$pagadores[0]->pagador_estado == "PA" ? 'selected' : ''}}>PA</option>
                        <option value="PB" {{$pagadores[0]->pagador_estado == "PB" ? 'selected' : ''}}>PB</option>
                        <option value="PR" {{$pagadores[0]->pagador_estado == "PR" ? 'selected' : ''}}>PR</option>
                        <option value="PE" {{$pagadores[0]->pagador_estado == "PE" ? 'selected' : ''}}>PE</option>
                        <option value="PI" {{$pagadores[0]->pagador_estado == "PI" ? 'selected' : ''}}>PI</option>
                        <option value="RJ" {{$pagadores[0]->pagador_estado == "RJ" ? 'selected' : ''}}>RJ</option>
                        <option value="RN" {{$pagadores[0]->pagador_estado == "RN" ? 'selected' : ''}}>RN</option>
                        <option value="RS" {{$pagadores[0]->pagador_estado == "RS" ? 'selected' : ''}}>RS</option>
                        <option value="RO" {{$pagadores[0]->pagador_estado == "RO" ? 'selected' : ''}}>RO</option>
                        <option value="RR" {{$pagadores[0]->pagador_estado == "RR" ? 'selected' : ''}}>RR</option>
                        <option value="SC" {{$pagadores[0]->pagador_estado == "SC" ? 'selected' : ''}}>SC</option>
                        <option value="SP" {{$pagadores[0]->pagador_estado == "SP" ? 'selected' : ''}}>SP</option>
                        <option value="SE" {{$pagadores[0]->pagador_estado == "SE" ? 'selected' : ''}}>SE</option>
                        <option value="TO" {{$pagadores[0]->pagador_estado == "TO" ? 'selected' : ''}}>TO</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    @endif
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Alterar
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExcluirModal">
        Excluir
    </button>
    <button type="button" class="btn btn-secondary" onclick="location.href='{{action('ResponsavelController@localizaResponsavelPorAluno', $r->aluno_id)}}'">Voltar</button>

    <!-- Cadastrar Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar Responsável</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração do Responsável
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Excluir Modal -->
    <div class="modal fade" id="ExcluirModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalExcluir" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir Responsável</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão do Responsável
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="location.href='{{action('ResponsavelController@exclui', $r->responsavel_id)}}'">Sim</button>
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