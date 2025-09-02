@extends('layouts.app')

@section('title', 'Criar Evento')

@section('content')
<div class="container">
    <h2>Criar Novo Evento</h2>
    <form action="{{ route('events.store') }}" method="POST" class="event-form">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" name="date" id="date" required>
        </div>
        <div class="form-group">
            <label for="location">Localização</label>
            <input type="text" name="location" id="location" required>
        </div>
        <div class="form-group">
            <label for="image">Imagem (URL)</label>
            <input type="url" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
