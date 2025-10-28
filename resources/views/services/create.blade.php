@extends('layouts.main')

@section('content')
<h1>Novo Serviço</h1>
<form method="POST" action="/services">@csrf
<label>Nome <input name="name"/></label>
<label>Preço <input name="unit_price"/></label>
<label>Unidade <input name="unit"/></label>
<button>Criar</button>
</form>
@endsection
