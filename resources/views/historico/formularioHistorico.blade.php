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

<h1>Novo Histórico de Instituição</h1>
<form action="{{action('HistoricoController@adiciona')}}" method="post">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Nome da Instituição</label>
                    <input type="hidden" name="aluno_id" class="form-control" value="{{ $alunos[0]->aluno_id }}" />
                    <input name="historico_instituicao_nome" class="form-control"
                        value="{{ old('historico_instituicao_nome') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label>Ano</label>
                    <input name="historico_instituicao_ano" class="form-control"
                        value="{{ old('historico_instituicao_ano') }}" />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Série</label>
                    <input name="historico_instituicao_serie" class="form-control" id="historico_instituicao_serie"
                        value="{{ old('historico_instituicao_serie') }}" />
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CadastrarModal">
        Cadastrar
    </button>
    <button type="button" class="btn btn-secondary"
        onclick="location.href='{{action('HistoricoController@localizaHistoricoPorAluno',$alunos[0]->aluno_id)}}'">Voltar</button>


    <!-- Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Cadastrar Histórico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma o cadastramento do Histórico?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>

@stop