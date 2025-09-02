@extends('layouts.app')
@section('content')
<h1>{{ $event->title }}</h1>
<p>{{ $event->description }}</p>
<p>Data: {{ $event->date }}</p>
<p>Local: {{ $event->location }}</p>
<p>Convidados: {{ $event->guests }}</p>
<a href="/events/{{ $event->id }}/budget/builder">Montar Orçamento</a>
@endsection
