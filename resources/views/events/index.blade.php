@extends('layouts.app')

@section('title', 'Meus Eventos')

@section('content')
<div class="container">

    <h2 class="page-title">Meus Eventos</h2>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:12px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botão criar novo --}}
    <div style="text-align:right; margin-bottom: 18px;">
        <a href="{{ route('events.create') }}" class="btn-primary-submit">+ Criar Evento</a>
    </div>

    {{-- Listagem de eventos --}}
    @if($events->count())
        <div class="events-grid">
            @foreach($events as $event)
                <div class="event-card">

                    {{-- Imagem do evento ou placeholder --}}
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Imagem do evento">
                    @else
                        <img src="https://via.placeholder.com/600x300?text=Sem+Imagem" alt="Sem imagem">
                    @endif

                    <div class="event-info">
                        <h3>{{ $event->title }}</h3>

                        <div class="event-meta">
                            📍 {{ $event->location }} <br>
                            📅 {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} <br>
                            🏷️ Categoria: <strong>{{ $event->category }}</strong> <br>
                            @php
    $statusClass = match($event->status) {
        'Planejado' => 'status-planejado',
        'Em andamento' => 'status-andamento',
        'Concluído' => 'status-concluido',
        default => 'status-planejado'
    };
@endphp

<span class="status-badge {{ $statusClass }}">
    {{ $event->status }}
</span>

                        </div>

                        <div class="event-actions">
                            <a class="btn-sm btn-edit" href="{{ route('events.edit', $event->id) }}">Editar</a>
                            <a class="btn-sm btn-budget" href="{{ route('events.budget', $event->id) }}">Orçamento</a>
                            <a class="btn-sm btn-report" href="{{ route('events.report', $event->id) }}">Relatório</a>
                            <a class="btn-sm btn-pdf" href="{{ route('events.report.pdf', $event->id) }}">PDF</a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este evento?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-delete" type="submit">Excluir</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="no-events" style="margin-top:20px; text-align:center; color:#666;">Você ainda não tem eventos cadastrados.</p>
    @endif

</div>
@endsection
