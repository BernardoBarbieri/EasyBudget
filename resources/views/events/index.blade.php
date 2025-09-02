@extends('layouts.app')

@section('title', 'Meus Eventos')

@section('content')
<div class="container">
    <h2>Meus Eventos</h2>

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px;border-radius:5px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('events.create') }}" class="btn btn-primary" style="margin-bottom:20px;">+ Criar Evento</a>

    @if($events->count())
        <div class="events-grid">
            @foreach($events as $event)
                <div class="event-card">
                    <div class="event-info">
                        <h3>{{ $event->title }}</h3>
                        <p>{{ $event->description }}</p>
                        <div class="event-meta">
                            <span><i class="fas fa-calendar-alt"></i> {{ $event->date }}</span>
                            <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                        </div>

                        <div style="margin-top:12px; display:flex; gap:8px; flex-wrap:wrap;">
                            <a class="btn btn-outline" href="{{ route('events.edit', $event->id) }}">Editar</a>
                            <a class="btn btn-outline" href="{{ route('events.budget', $event->id) }}">Orçamento</a>
                            <a class="btn btn-outline" href="{{ route('events.report', $event->id) }}">Relatório</a>
                            <a class="btn btn-outline" href="{{ route('events.report.pdf', $event->id) }}">PDF</a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" type="submit">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="no-events">Nenhum evento cadastrado.</p>
    @endif
</div>
@endsection
