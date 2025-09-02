@extends('layouts.app')

@section('title', 'Home')

@section('content')
<main>
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Organize ou participe dos melhores eventos</h2>
                <p>Conecte-se com pessoas que compartilham seus interesses e crie memórias inesquecíveis.</p>
                <button id="exploreBtn" class="btn btn-primary btn-large">Explorar Eventos</button>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/event-hero.png') }}" alt="Pessoas em um evento">
            </div>
        </div>
    </section>

    <section id="eventos" class="featured-events">
        <div class="container">
            <h2>Eventos em Destaque</h2>
            <div class="events-grid">
                <!-- Aqui podem entrar eventos destacados -->
            </div>
        </div>
    </section>
</main>

<!-- Modal Login -->
<div id="loginModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Login</h2>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="loginEmail">Email</label>
                <input type="email" id="loginEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Senha</label>
                <input type="password" id="loginPassword" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <p class="form-footer">Não tem uma conta? <a href="#" id="showRegister">Cadastre-se</a></p>
    </div>
</div>

<!-- Modal Cadastro -->
<div id="registerModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Cadastre-se</h2>
        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="registerName">Nome</label>
                <input type="text" id="registerName" name="name" required>
            </div>
            <div class="form-group">
                <label for="registerEmail">Email</label>
                <input type="email" id="registerEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="registerPassword">Senha</label>
                <input type="password" id="registerPassword" name="password" required>
            </div>
            <div class="form-group">
                <label for="registerConfirmPassword">Confirmar Senha</label>
                <input type="password" id="registerConfirmPassword" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        <p class="form-footer">Já tem uma conta? <a href="#" id="showLogin">Faça login</a></p>
    </div>
</div>
@endsection
