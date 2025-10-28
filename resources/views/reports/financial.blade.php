<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Financeiro - {{ $event->title }}</title></head>
<body>
  <h1>💰 Relatório Financeiro</h1>
  @php $total = 0; @endphp
  @if($event->budgets && $event->budgets->count())
    <table border="1" cellpadding="6" cellspacing="0">
      <tr><th>Item</th><th>Preço</th><th>Qtd</th><th>Subtotal</th></tr>
      @foreach($event->budgets as $b)
        @php $sub = ($b->price ?? 0) * ($b->quantity ?? 1); $total += $sub; @endphp
        <tr>
          <td>{{ $b->name }}</td>
          <td>{{ number_format($b->price,2,',','.') }}</td>
          <td>{{ $b->quantity }}</td>
          <td>{{ number_format($sub,2,',','.') }}</td>
        </tr>
      @endforeach
    </table>
    <p><strong>Total:</strong> R$ {{ number_format($total,2,',','.') }}</p>
  @else
    <p>Sem dados financeiros.</p>
  @endif
</body>
</html>
