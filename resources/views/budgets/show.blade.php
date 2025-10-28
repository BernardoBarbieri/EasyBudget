@extends('layouts.main')


@section('title', 'Orçamento do Evento')

@section('content')
<h2 style="margin-bottom: 30px; color: var(--primary-color);">💰 Orçamento - {{ $event->title }}</h2>

<div class="event-card" style="padding: 20px;">
    <div class="event-info">
        <p><strong>Descrição:</strong> {{ $event->description }}</p>
        <p><strong>Data:</strong> {{ $event->date }}</p>
        <p><strong>Local:</strong> {{ $event->location }}</p>
    </div>

    <hr style="margin:20px 0;">

    <h3>Itens do Orçamento</h3>
    <ul style="list-style: none; padding:0; margin-top:15px;">
        @forelse ($event->budgets ?? [] as $budget)
            <li class="event-card" style="margin-bottom:10px; padding:10px;">
                <p><strong>{{ $budget->item }}</strong> - R$ {{ number_format($budget->price, 2, ',', '.') }}</p>
            </li>
        @empty
            <p class="no-events">Nenhum item de orçamento cadastrado.</p>
        @endforelse
    </ul>

    <form action="{{ route('events.storeBudget', $event->id) }}" method="POST" style="margin-top:20px;">
        @csrf
        <div class="form-group">
            <label for="item">Item</label>
            <input type="text" name="item" id="item" required>
        </div>
        <div class="form-group">
            <label for="price">Preço</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Item</button>
    </form>
</div>
@endsection
