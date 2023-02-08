@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-12 d-flex flex-column align-items-center">
            <h1 class="text-center">ABSX Suporte</h1>
            <p class="text-center mb-3">Quantidade de chamados em Aberto: <strong>{{ $openHelpsCount }} </strong></p>
            <p class="text-center mb-3">Quantidade de chamados em Andamento: <strong>{{ $inProgressHelpsCount }} </strong></p>
            <p class="text-center mb-3">Quantidade de chamados em Atraso: <strong>{{ $overdueHelpsCount }} </strong></p>
            <p class="text-center mb-3">Quantidade de chamados Resolvido: <strong>{{ $resolvedHelpsCount }} </strong></p>
            @if(Auth::user()->user_type == 'client')
            <a href="{{ route('helpdesk.create') }}" class="btn btn-primary btn-lg mx-3">Novo Ticket</a>
            @endif
        </div>
    </div>
</div>

@endsection