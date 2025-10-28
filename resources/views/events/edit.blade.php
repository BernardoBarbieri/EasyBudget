@extends('layouts.main')


@section('title', 'Editar Evento')

@section('content')
<div class="form-wrapper">

    <h1>Editar Evento</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" value="{{ $event->title }}" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="description" class="form-textarea" rows="4">{{ $event->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Data</label>
            <input type="date" name="date" value="{{ $event->date }}" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Localização</label>
            <input type="text" name="location" value="{{ $event->location }}" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Imagem do Evento</label>
            <input type="file" name="image" class="form-file">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="mt-3" style="max-width: 200px; border-radius: 8px;">
            @endif
        </div>

        <div class="form-group">
            <label>Categoria</label>
            <select name="category" class="form-select" required>
                <option value="Casamento" {{ $event->category == 'Casamento' ? 'selected' : '' }}>Casamento</option>
                <option value="Festa" {{ $event->category == 'Festa' ? 'selected' : '' }}>Festa</option>
                <option value="Show" {{ $event->category == 'Show' ? 'selected' : '' }}>Show</option>
                <option value="Formatura" {{ $event->category == 'Formatura' ? 'selected' : '' }}>Formatura</option>
                <option value="Reunião Corporativa" {{ $event->category == 'Reunião Corporativa' ? 'selected' : '' }}>Reunião Corporativa</option>
                <option value="Seminário" {{ $event->category == 'Seminário' ? 'selected' : '' }}>Seminário</option>
                <option value="Treinamento / Workshop" {{ $event->category == 'Treinamento / Workshop' ? 'selected' : '' }}>Treinamento / Workshop</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="Planejado" {{ $event->status == 'Planejado' ? 'selected' : '' }}>Planejado</option>
                <option value="Em andamento" {{ $event->status == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                <option value="Concluído" {{ $event->status == 'Concluído' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <button class="btn-primary-submit">Salvar Alterações</button>

    </form>

</div>
@endsection
