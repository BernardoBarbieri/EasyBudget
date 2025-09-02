@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
<div class="container">
    <h2>Editar Evento</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST" class="event-card" style="padding:20px;">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" value="{{ $event->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description">{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" name="date" id="date" value="{{ $event->date }}" required>
        </div>
        <div class="form-group">
            <label for="location">Localização</label>
            <input type="text" name="location" id="location" value="{{ $event->location }}" required>
        </div>
        <div class="form-group">
            <label for="image">Imagem (URL)</label>
            <input type="url" name="image" id="image" value="{{ $event->image }}">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
