@extends('layouts.main')

@section('content')
<h1>Serviços</h1>
<a href="/services/create">Novo Serviço</a>
<table border="1"><tr><th>Nome</th><th>Preço</th></tr>
@foreach($list as $s)
<tr><td>{{ $s->name }}</td><td>{{ $s->unit_price }}</td></tr>
@endforeach
</table>
{{ $list->links() }}
@endsection
