@extends('layouts.main')

@section('content')
<h1>Montar Orçamento - {{ $event->title }}</h1>
<div>
<form action="/budgets/{{ $budget->id }}/items" method="POST">@csrf
<select name="service_item_id">@foreach($catalog as $c)<option value="{{ $c->id }}">{{ $c->name }} - R$ {{ $c->unit_price }}</option>@endforeach</select>
<input type="number" name="quantity" value="1" min="1">
<button>Adicionar</button>
</form>
</div>
<div>
<h3>Itens</h3>
<table border="1"><tr><th>Item</th><th>Qtd</th><th>Total</th></tr>
@foreach($budget->items as $it)
<tr><td>{{ $it->service->name }}</td><td>{{ $it->quantity }}</td><td>{{ $it->total }}</td></tr>
@endforeach
</table>
</div>
<form action="/budgets/{{ $budget->id }}" method="POST">@csrf @method('PATCH')
<label>Taxa (%) <input name="tax_rate" value="{{ $budget->tax_rate }}"/></label>
<label>Desconto <input name="discount" value="{{ $budget->discount }}"/></label>
<button>Atualizar</button>
</form>
@endsection
