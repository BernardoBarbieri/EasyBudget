@extends('layouts.main')

@section('content')
<h1>{{ $event->title }}</h1>
<p><strong>Categoria:</strong> {{ $event->category }}</p>
<p><strong>Status:</strong> {{ $event->status }}</p>
<p>{{ $event->description }}</p>
<p>Data: {{ $event->date }}</p>
<p>Local: {{ $event->location }}</p>
<div class="card mt-4">
    <div class="card-header">
        <strong>Localização do Evento</strong>
    </div>
    <div class="card-body">
        <p>{{ $event->location }}</p>
        <iframe
            width="100%"
            height="350"
            style="border:0; border-radius:8px;"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q={{ urlencode($event->location) }}&output=embed">
        </iframe>
    </div>
</div>


<div class="mb-3">
    <iframe
        width="100%"
        height="350"
        frameborder="0" style="border:0; border-radius:8px;"
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAzq0zgI02VL3HZVydSesVCZOf1d4maxvg&q={{ urlencode($event->location) }}"
        allowfullscreen>
    </iframe>
</div>

<p>Convidados: {{ $event->guests }}</p>
<a href="/events/{{ $event->id }}/budget/builder">Montar Orçamento</a>


<div class="card mt-4">
    <div class="card-header">
        <strong>Convidados</strong>
    </div>

    <div class="card-body">
        
        {{-- Formulário para adicionar convidado --}}
        <form action="{{ route('guests.store', $event->id) }}" method="POST" class="d-flex mb-3" style="max-width: 400px;">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Nome do convidado" required>
            <button class="btn btn-primary ms-2">Adicionar</button>
        </form>

        {{-- Lista de convidados --}}
        @forelse($event->guests as $guest)
            <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">

                <span>{{ $guest->name }}</span>

                <div class="d-flex gap-2">

                    {{-- Confirmar / Pendênte --}}
                    <a href="{{ route('guests.confirm', $guest->id) }}" 
                        class="btn btn-sm {{ $guest->confirmed ? 'btn-success' : 'btn-outline-secondary' }}">
                        {{ $guest->confirmed ? 'Confirmado ✅' : 'Pendente ⏳' }}
                    </a>

                    {{-- Remover --}}
                    <form action="{{ route('guests.destroy', $guest->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-muted">Nenhum convidado adicionado.</p>
        @endforelse
    </div>
</div>

@endsection
