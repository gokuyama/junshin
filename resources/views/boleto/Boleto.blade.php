@extends('layout.principal')
@section('conteudo')

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;" data-toggle="modal"
    data-target="#filtraModal">Gerar Boletos</button>

<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"
    onclick="location.href='{{route('boletos.retorno')}}'">Processa arquivo de retorno</button>


<div class="modal fade" id="filtraModal" tabindex="-1" role="dialog" aria-labelledby="filtraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtraModalLabel">Selecione o mês de competência</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{action('BoletoController@listaPorAluno')}}" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mês</label>
                        <select id="mesCompetencia" class="form-control" name="mesCompetencia">
                            <option value="1">JANEIRO</option>
                            <option value="2">FEVEREIRO</option>
                            <option value="3">MARÇO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAIO</option>
                            <option value="6">JUNHO</option>
                            <option value="7">JULHO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SETEMBRO</option>
                            <option value="10">OUTUBRO</option>
                            <option value="11">NOVEMBRO</option>
                            <option value="12">DEZEMBRO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancela</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

