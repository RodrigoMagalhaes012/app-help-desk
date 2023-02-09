@extends('layouts.app')

@section('title', "Ticket - $helpdeskCall->id ")

@section('content')

<h1>Ticket - {{ $helpdeskCall->id }}</h1>

<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Assunto </label>
    <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto:" value="{{ $helpdeskCall->subject  }}" disabled>
</div>
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Descrição </label>
    <textarea class="form-control" id="description" name="description" rows="3" disabled>{{ $helpdeskCall->description }}</textarea>
</div>

<form action="{{ route('helpdesk.destroy', $helpdeskCall->id) }}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Deletar</button>
</form>

@endsection