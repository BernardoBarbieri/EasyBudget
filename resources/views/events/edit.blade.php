<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

@if (session('status'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">
                @if (session('status') === 'profile-updated')
                    Seus dados de perfil (Nome/Email) foram atualizados.
                @elseif (session('status') === 'password-updated')
                    Sua senha foi alterada com segurança.
                @else
                    Operação realizada com sucesso!
                @endif
            </span>
        </div>
    </div>
@endif

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        @if (session('status') === 'profile-updated')
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <span class="font-medium">Sucesso!</span> Seus dados foram salvos.
            </div>
        @endif
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
           ...

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
