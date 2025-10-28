@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Estilo geral da página */
    body {
        background: #f8fafc;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .dashboard-header h1 {
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 10px;
    }

    .dashboard-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stats-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .stats-card h5 {
        font-size: 1.1rem;
        color: #4b5563;
        margin-bottom: 10px;
    }

    .stats-card .number {
        font-size: 2.4rem;
        font-weight: bold;
        color: #1e40af;
    }

    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .chart-card h4 {
        color: #1e293b;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .btn-view {
        display: inline-block;
        margin-top: 10px;
        font-weight: 500;
        text-decoration: none;
        color: #2563eb;
    }

    .btn-view:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    {{-- Cabeçalho bonito --}}
    <div class="dashboard-header text-center">
        <h1>📊 Painel de Controle</h1>
        <p>Bem-vindo de volta, <strong>{{ Auth::user()->name }}</strong>!  
        Aqui está um resumo dos seus eventos, convidados e orçamentos.</p>
    </div>

    {{-- Cards de estatísticas --}}
    <div class="stats-cards">
        <div class="stats-card">
            <h5>Eventos</h5>
            <div class="number">{{ $events ?? 0 }}</div>
            <a href="{{ route('events.index') }}" class="btn-view">Ver eventos →</a>
        </div>

        <div class="stats-card">
            <h5>Convidados</h5>
            <div class="number">{{ $guests ?? 0 }}</div>
            <a href="{{ route('events.index') }}" class="btn-view">Ver convidados →</a>
        </div>

        <div class="stats-card">
            <h5>Orçamentos</h5>
            <div class="number">R$ {{ number_format($totalBudget ?? 0, 2, ',', '.') }}</div>
            <a href="{{ route('events.index') }}" class="btn-view">Ver orçamentos →</a>
        </div>
    </div>

    {{-- Gráfico de resumo financeiro --}}
    <div class="chart-card">
        <h4>💰 Resumo Financeiro dos Eventos</h4>
        <canvas id="financeChart" height="120"></canvas>
    </div>
</div>

{{-- Script do gráfico --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('financeChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels ?? []),
            datasets: [{
                label: 'Total (R$)',
                data: @json($chartValues ?? []),
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: 'rgba(37, 99, 235, 1)',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#475569' } },
                x: { ticks: { color: '#475569' } }
            }
        }
    });
});
</script>
@endsection
