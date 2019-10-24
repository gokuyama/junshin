@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um link de verificação foi enviado para seu e-mail.') }}
                        </div>
                    @endif

                    {{ __('Antes de prosseguir, verifique o link no seu e-mail.') }}
                    {{ __('Se você não recebeu o email') }}, <a href="{{ route('verification.resend') }}">{{ __('clique aqui para solicitar novamente') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
