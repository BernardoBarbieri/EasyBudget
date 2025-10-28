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
    @else
        <p class="no-events">Você ainda não tem eventos. Clique em “Criar Evento”.</p>
    @endif

    {{-- Gráfico de resumo financeiro --}}
    <div class="mt-5">
        <h2>Resumo Financeiro dos Eventos</h2>
        <p>Veja o total de orçamento de cada evento cadastrado.</p>
        <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
            <canvas id="eventChart" width="400" height="150"></canvas>
        </div>
    </div>
</div>

{{-- Script do Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('eventChart');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels ?? []),
            datasets: [{
                label: 'Total (R$)',
                data: @json($totais ?? []),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
