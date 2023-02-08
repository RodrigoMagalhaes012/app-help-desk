@extends('layouts.app')
@section('title', 'Novo Ticket')
@section('content')

<h1>Novo Ticket</h1>

@include('includes.validations-form')

<form action="{{ route('helpdesk.store') }}" method="post">
    @csrf
    @include('helpdesk._partials.form')
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

@endsection