@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container">
    <h2 style="margin-bottom: 30px; color: var(--primary-color);">👤 Editar Perfil</h2>

    @if(session('success'))
        <div style="background: #d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="event-card" style="padding: 20px;">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Nome</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Nova Senha (opcional)</label>
            <input id="password" type="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Nova Senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');" style="margin-top:20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir Conta</button>
    </form>
</div>
@endsection
