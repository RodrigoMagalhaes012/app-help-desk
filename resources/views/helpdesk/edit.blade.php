@extends('layouts.app')
@section('title', "Editar chamado {{ $helpdeskCall->id }}")
@section('content')

<h1>Editar Ticket - {{ $helpdeskCall->id }}</h1>

@include('includes.validations-form')

<form action="{{ route('helpdesk.update', $helpdeskCall->id) }}" method="post">
    @method('PUT')
    @csrf
    @include('helpdesk._partials.form')

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" name="status" id="status">
            <option value="Open" {{ ($helpdeskCall->status == "Open") ? 'selected' : '' }}>Aberto</option>
            <option value="In Progress" {{ ($helpdeskCall->status == "In Progress") ? 'selected' : '' }}>Em andamento</option>
            <option value="Overdue" {{ ($helpdeskCall->status == "Overdue") ? 'selected' : '' }}>Atrasado</option>
            <option value="Resolved" {{ ($helpdeskCall->status == "Resolved") ? 'selected' : '' }}>Resolvido</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="user_id_client" class="form-label">Cliente</label>
        <input type="text" class="form-control" name="user_id_client" id="user_id_client" value="{{ $helpdeskCall->userClient->name ?? old('user_id_client') }}" disabled>
    </div>
    <div class="mb-3">
        <label for="user_id_agent" class="form-label">Vendedor</label>
        <select class="form-control" name="user_id_agent" id="user_id_agent">
            @foreach($agents ?? '' as $agent)
            <option value="{{ $agent->id }}" {{ ($helpdeskCall->user_id_agent == $agent->id) ? 'selected' : '' }}>{{ $agent->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

@endsection