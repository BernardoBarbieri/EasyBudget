<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório - {{ $event->title }}</title>
    {{-- Para DomPDF, use public_path --}}
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}" type="text/css">
</head>
<body>
    <h1>Relatório do Evento</h1>
    <h2>{{ $event->title }}</h2>

    <p><strong>Descrição:</strong> {{ $event->description }}</p>
    <p><strong>Data:</strong> {{ $event->date }}</p>
    <p><strong>Local:</strong> {{ $event->location }}</p>

    <h3 style="margin-top:20px;">Itens do Orçamento</h3>
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:left;">Item</th>
                <th style="text-align:right;">Preço (R$)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($event->budgets ?? [] as $b)
                <tr>
                    <td>{{ $b->item }}</td>
                    <td style="text-align:right;">{{ number_format($b->price, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="2">Nenhum item de orçamento cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">
        <strong>Total:</strong>
        R$
        {{ number_format(($event->budgets ?? collect([]))->sum('price'), 2, ',', '.') }}
    </p>
</body>
</html>
