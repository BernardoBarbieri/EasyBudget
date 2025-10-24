@extends('layouts.app')

@section('title', 'Criar Novo Evento')

@section('content')
<div class="form-wrapper">

    <h1>Criar Novo Evento</h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="description" class="form-textarea" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Data</label>
            <input type="date" name="date" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Localização</label>
            <input type="text" name="location" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Imagem do Evento</label>
            <input type="file" name="image" class="form-file">
        </div>

        <div class="form-group">
            <label>Categoria</label>
            <select name="category" class="form-select" required>
                <option value="">Selecione...</option>
                <option value="Casamento">Casamento</option>
                <option value="Festa">Festa</option>
                <option value="Show">Show</option>
                <option value="Formatura">Formatura</option>
                <option value="Reunião Corporativa">Reunião Corporativa</option>
                <option value="Seminário">Seminário</option>
                <option value="Treinamento / Workshop">Treinamento / Workshop</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="Planejado">Planejado</option>
                <option value="Em andamento">Em andamento</option>
                <option value="Concluído">Concluído</option>
            </select>
        </div>

        <button class="btn-primary-submit">Salvar</button>
    </form>

</div>
@endsection
