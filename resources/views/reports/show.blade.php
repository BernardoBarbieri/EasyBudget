<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório do Evento</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <h1>Relatório do Evento: {{ $event->title }}</h1>
    <p><strong>Data:</strong> {{ $event->date }}</p>
    <p><strong>Local:</strong> {{ $event->location }}</p>

    <h2>Itens do Orçamento</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->budgets as $budget)
                <tr>
                    <td>{{ $budget->item }}</td>
                    <td>R$ {{ number_format($budget->price, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        EasyBudget - Relatório gerado em {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
