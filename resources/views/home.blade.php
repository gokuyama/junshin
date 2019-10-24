@extends('layout.principal')
@section('conteudo')


<div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div>
            <h1>
                <img style="display: inline-block;" src="/img/imagem.png" alt="Imagem do Junshin">
            </h1>
        </div>
    </div>
</div>
@endsection