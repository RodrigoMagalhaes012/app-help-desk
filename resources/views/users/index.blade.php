@extends('layouts.app')

@section('title', 'Listagem do Usuários')

@section('content')

<h1>Listagem de usuários</h1>

<div class="row">
    <div class="col">
        <form action="{{ route('users.index') }}" method="get">
            <input type="text" name="search" placeholder="Pesquisar">
            <button type="button" class="btn btn-secondary">Pesquisar</button>
        </form>
    </div>

    <div class="col">
        <a href=" {{ route('users.create') }}"> <button type="button" class="btn btn-primary"> Novo Usuário </button></a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Aberto</th>
            <th scope="col">Em Andamento</th>
            <th scope="col">Resolvido</th>
            <th scope="col">Atrasado</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->openCallsCount }}</td>
            <td>{{ $user->inProgressCallsCount }}</td>
            <td>{{ $user->resolvedCallsCount }}</td>
            <td>{{ $user->overdueCallsCount }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}"> Editar</a> |
                <a href="{{ route('users.show', $user->id) }}"> Detalhes</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </tbody>
</table>

<div class="row">
    {{ $users->appends([
        'search'=> request()->get('search', '')
        ])->links() }}
</div>

@endsection