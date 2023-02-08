@extends('layouts.app')

@section('title', 'Listagem do Chamados')

@section('content')

<h1>Listagem de Chamados</h1>

<div class="row">
    <div class="col">
        <form action="{{ route('helpdesk.index') }}" method="get">
            <input type="text" name="search" placeholder="Pesquisar">
            <button type="button" class="btn btn-secondary">Pesquisar</button>
        </form>
    </div>

    <div class="col">
        @if(Auth::user()->user_type == 'client')
        <a href=" {{ route('helpdesk.create') }}"> <button type="button" class="btn btn-primary"> Novo Ticket </button></a>
        @endif
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Assunto</th>
            <th scope="col">Status</th>
            <th scope="col">Cliente</th>
            <th scope="col">Vendedor</th>
            <th scope="col">Data Criação</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($helpdeskCall as $helpdesk)
        <tr>
            <th scope="row">{{ $helpdesk->id }}</th>
            <td>{{ $helpdesk->subject }}</td>
            <td>
                {{ $helpdesk->status == 'Open' ? 'Aberto' : ($helpdesk->status == 'In Progress' ? 'Em andamento' : ($helpdesk->status == 'Resolved' ? 'Resolvido' : ($helpdesk->status == 'Overdue' ? 'Atrasado' : ''))) }}
            </td>
            <td>{{ $helpdesk->userClient->name }}</td>
            <td>{{ $helpdesk->userAgent->name }}</td>
            <td>{{ $helpdesk->created_at->format('d/m/Y H:i:s') }}</td>
            <td>
                <a href="{{ route('helpdesk.edit', $helpdesk->id) }}"> Editar</a> |
                <a href="{{ route('helpdesk.show', $helpdesk->id) }}"> Detalhes</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </tbody>
</table>

<div class="row">
    {{ $helpdeskCall->appends([
        'search'=> request()->get('search', '')
        ])->links() }}
</div>

@endsection