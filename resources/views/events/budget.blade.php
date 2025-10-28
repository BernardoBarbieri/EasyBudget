@extends('layouts.main')

@section('title', 'Orçamento do Evento')

@section('content')
<div class="container">
    <div class="header">
        <h2 class="page-title">
            💰 Orçamento de <strong>{{ $event->title }}</strong>
        </h2>
        <p class="text-muted">Gerencie os custos e veja o total estimado em tempo real.</p>
    </div>

    {{-- MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- RESUMO FINANCEIRO --}}
    <div class="budget-summary">
        <div class="summary-card">
            <h5>Total</h5>
            <p class="value">R$ {{ number_format($event->budgets->sum(fn($b) => $b->price * $b->quantity), 2, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <h5>Itens</h5>
            <p class="value">{{ $event->budgets->count() }}</p>
        </div>
        <div class="summary-card">
            <h5>Média por Item</h5>
            <p class="value">
                R$ {{ $event->budgets->count() ? number_format($event->budgets->avg(fn($b) => $b->price * $b->quantity), 2, ',', '.') : '0,00' }}
            </p>
        </div>
    </div>

    {{-- FORMULÁRIO DE ADIÇÃO DE ITEM --}}
    <div class="card mt-4">
        <div class="card-header">Adicionar Item</div>
        <div class="card-body">
            <form action="{{ route('budgets.store') }}" method="POST" class="budget-form">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="form-row">
                    <input type="text" name="description" class="form-control" placeholder="Descrição do item" required>
                    <input type="number" name="price" step="0.01" class="form-control" placeholder="Preço (R$)" required>
                    <input type="number" name="quantity" class="form-control" placeholder="Qtd." required>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Adicionar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABELA DE ITENS --}}
    <div class="table-container mt-4">
        @if($event->budgets->count())
            <table class="budget-table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Preço Unitário</th>
                        <th>Qtd.</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->budgets as $budget)
                        <tr>
                            <td>{{ $budget->description }}</td>
                            <td>R$ {{ number_format($budget->price, 2, ',', '.') }}</td>
                            <td>{{ $budget->quantity }}</td>
                            <td>
                                <strong>R$ {{ number_format($budget->price * $budget->quantity, 2, ',', '.') }}</strong>
                            </td>
                            <td>
                                <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este item?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted mt-3">Nenhum item adicionado ainda. Comece adicionando um orçamento acima. 🧾</p>
        @endif
    </div>
</div>

<style>
/* === ESTILOS GERAIS === */
.container {
    max-width: 950px;
    margin: 0 auto;
    padding: 30px;
}
.page-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 5px;
}
.text-muted {
    color: #6c757d;
}
.alert {
    padding: 10px 20px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 6px;
}

/* === RESUMO FINANCEIRO === */
.budget-summary {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: 20px;
}
.summary-card {
    flex: 1;
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    text-align: center;
    padding: 15px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
}
.summary-card h5 {
    color: #555;
    margin-bottom: 5px;
}
.summary-card .value {
    font-size: 1.4rem;
    color: #007bff;
    font-weight: bold;
}

/* === FORMULÁRIO === */
.budget-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.budget-form .form-control {
    flex: 1;
    min-width: 150px;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
.budget-form button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    transition: 0.2s;
}
.budget-form button:hover {
    background-color: #0056b3;
}

/* === TABELA === */
.table-container {
    margin-top: 30px;
    overflow-x: auto;
}
.budget-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
}
.budget-table th, .budget-table td {
    padding: 12px 15px;
    text-align: left;
}
.budget-table th {
    background-color: #007bff;
    color: white;
}
.budget-table tr:nth-child(even) {
    background-color: #f8f9fa;
}
.budget-table td strong {
    color: #28a745;
}
.btn-danger {
    background-color: #dc3545;
    border: none;
    border-radius: 6px;
    color: white;
    padding: 5px 8px;
}
.btn-danger:hover {
    background-color: #b02a37;
}
</style>
@endsection
