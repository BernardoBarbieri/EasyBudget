<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório do Evento - {{ $event->title }}</title>

    <style>
        /* 1. Reset Básico para PDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 1.5cm;
        }

        /* 2. Estilos de Branding e Cabeçalho */
        .header {
            background-color: #4f46e5; /* Cor principal do projeto (Indigo/Roxo) */
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 18pt;
            margin: 0;
        }

        /* 3. Estilos de Conteúdo */
        .section-title {
            font-size: 14pt;
            color: #1f2937;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 5px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        .event-details {
            margin-bottom: 20px;
            font-size: 11pt;
            border-left: 5px solid #4f46e5;
            padding-left: 10px;
        }

        /* 4. Tabela de Métricas (Para os contadores) */
        .metrics-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            text-align: center;
        }

        .metrics-table th, .metrics-table td {
            border: 1px solid #e5e7eb;
            padding: 12px 8px;
        }

        .metrics-table th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: bold;
        }

        /* 5. Tabela de Detalhes (Orçamento/Convidados) */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table th, .data-table td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            font-size: 10pt;
        }

        .data-table th {
            background-color: #eef2ff; /* Cor clara do projeto */
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Relatório do Evento: {{ $event->title }}</h1>
        <p style="font-size: 10pt; margin-top: 5px;">EasyBudget - Geração {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="event-details">
        <p><strong>Data:</strong> {{ $event->date->format('d/m/Y') }}</p>
        <p><strong>Local:</strong> {{ $event->location }}</p>
        <p><strong>Descrição:</strong> {{ $event->description ?? 'Nenhuma descrição fornecida.' }}</p>
    </div>

    <h2 class="section-title">Resumo e Métricas Chave</h2>
    <table class="metrics-table">
        <thead>
            <tr>
                <th>Total de Convidados</th>
                <th>Convidados Confirmados</th>
                <th>Total do Orçamento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $totalGuests }}</td>
                <td>{{ $confirmedGuests }}</td>
                <td style="font-weight: bold; color: #4f46e5;">R$ {{ number_format($totalBudget, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h2 class="section-title">Detalhe do Orçamento</h2>
    @if ($event->budgets->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Item</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->budgets as $budget)
                    <tr>
                        <td>{{ $budget->item }}</td>
                        <td>R$ {{ number_format($budget->price, 2, ',', '.') }}</td>
                        <td>{{ $budget->quantity }}</td>
                        <td>R$ {{ number_format($budget->price * $budget->quantity, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum item de orçamento cadastrado.</p>
    @endif
    
    <h2 class="section-title">Lista de Convidados</h2>
    @if ($event->guests->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Nome</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->guests as $guest)
                    <tr>
                        <td>{{ $guest->name }}</td>
                        <td style="color: {{ $guest->confirmed ? 'green' : 'red' }};">{{ $guest->confirmed ? 'Confirmado' : 'Pendente' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum convidado cadastrado.</p>
    @endif

</body>
</html>