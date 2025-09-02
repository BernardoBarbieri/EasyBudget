@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<h2 style="margin-bottom: 20px; color: var(--primary-color);">👤 Perfil do Usuário</h2>

<div class="event-card" style="padding: 20px;">
    <div class="event-info">
        <h3>{{ Auth::user()->name }}</h3>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p>🚧 Em breve você poderá editar suas informações.</p>
    </div>
</div>
@endsection
