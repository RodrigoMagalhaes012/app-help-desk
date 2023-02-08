@extends('layouts.app')

@section('title', 'Listagem do usuário')

@section('content')

<h1>Listagem do usuário {{ $user->name }}</h1>

<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Nome </label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Nome:" value="{{ $user->name  }}" disabled>
</div>
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email </label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email:" value="{{ $user->email }}" disabled>
</div>

<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Deletar</button>
</form>

@endsection