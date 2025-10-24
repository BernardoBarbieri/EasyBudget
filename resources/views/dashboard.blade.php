@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Dashboard</h2>

    {{-- Ações rápidas --}}
    <div class="events-grid" style="margin-bottom: 24px;">
        <div class="dashboard-card">
            <h3>Criar Novo Evento</h3>
            <p>Adicione rapidamente um novo evento ao sistema.</p>
            <a href="{{ route('events.create') }}" class="btn btn-primary">Criar Evento</a>
        </div>
        <div class="dashboard-card">
            <h3>Gerenciar Eventos</h3>
            <p>Veja, edite ou exclua seus eventos cadastrados.</p>
            <a href="{{ route('events.index') }}" class="btn btn-outline">Ir para Eventos</a>
        </div>
        <div class="dashboard-card">
            <h3>Perfil</h3>
            <p>Atualize seus dados de usuário.</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline">Editar Perfil</a>
        </div>
    </div>


    {{-- Meus eventos --}}
    <h2 style="margin-top: 10px;">Meus Eventos</h2>
    <p class="text-muted">Total de eventos: <strong>{{ $totalEvents }}</strong></p>

    @if(isset($events) && $events->count())
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

<div class="card mt-4">
    <div class="card-header">
        <strong>Resumo Financeiro dos Eventos</strong>
    </div>
    <div class="card-body">
        <canvas id="chartOrcamento"></canvas>
    </div>
</div>

    @else
        <p class="no-events">Você ainda não tem eventos. Clique em “Criar Evento”.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartOrcamento').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total (R$)',
                data: @json($totals),
                borderWidth: 1,
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
