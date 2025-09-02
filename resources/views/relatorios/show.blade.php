@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório do Evento: {{ $event->name }}</h1>

    <p><strong>Data:</strong> {{ $event->date }}</p>
    <p><strong>Local:</strong> {{ $event->location }}</p>
    <p><strong>Descrição:</strong> {{ $event->description }}</p>

    <h3>Itens do Orçamento</h3>
    @if($event->budgetItems->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($event->budgetItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total Geral:</strong>  
           R$ {{ number_format($event->budgetItems->sum(fn($i) => $i->price * $i->quantity), 2, ',', '.') }}
        </p>
    @else
        <p><em>Nenhum item de orçamento cadastrado para este evento.</em></p>
    @endif

    <a href="{{ route('events.report.pdf', $event->id) }}" class="btn btn-primary">Baixar PDF</a>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
