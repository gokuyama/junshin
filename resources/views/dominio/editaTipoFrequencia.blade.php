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

<h1>Editando o Tipo de Frequência: {{$t->tipos_frequencia_descricao}}</h1>
<form action="{{action('TipoFrequenciaController@altera',$t->tipo_frequencia_id)}}" method="get">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <label>Tipo de Frequência</label>
                    <input name="tipos_frequencia_descricao" class="form-control"
                        value="{{ $t->tipos_frequencia_descricao }}" />
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
        onclick="location.href='{{action('TipoFrequenciaController@lista')}}'">Voltar</button>

    <!-- Cadastrar Modal -->
    <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCadastrar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCadastrar">Alterar Tipo de Frequência</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a alteração do Tipo de Frequência?
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
                    <h5 class="modal-title" id="TituloModalExcluir">Excluir Tipo de Frequência</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão do Tipo de Frequência?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{action('TipoFrequenciaController@exclui', $t->tipo_frequencia_id)}}'">Sim</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>

@stop