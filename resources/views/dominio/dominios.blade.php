@extends('layout.principal')
@section('conteudo')

<h1>Tabelas de Domínio</h1>
<ul>
    <li><a href="{{ route('niveisConhecimentoJapones.lista') }}">Níveis de Conhecimento de Japonês</a></li>
    <li><a href="{{ route('niveisEscolaridade.lista') }}">Níveis de Escolaridade</a></li>
    <li><a href="{{ route('tiposDocumento.lista') }}">Tipos de Documento</a></li>
    <li><a href="{{ route('tiposFrequencia.lista') }}">Tipos de Frequência</a></li>
    <li><a href="{{ route('tiposResponsavel.lista') }}">Tipos de Responsável</a></li>
    <li><a href="{{ route('tiposTurma.lista') }}">Tipos de Turma</a></li>
    <li><a href="{{ route('turnos.lista') }}">Turnos</a></li>
</ul>
@stop