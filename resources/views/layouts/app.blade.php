<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Easy Budget')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS principal --}}
    <link rel="stylesheet" href="{{ asset('css/EasyBudget.css') }}">
    <link rel="stylesheet" href="{{ asset('css/internal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <i class="fas fa-calendar-alt"></i>
                <h1>Easy Budget</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('events.index') }}">Eventos</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('profile.edit') }}">Perfil</a></li>
                    @endauth
                </ul>
            </nav>
            <div class="auth-buttons">
                @guest
                    <button id="loginBtn" class="btn btn-outline">Login</button>
                    <button id="registerBtn" class="btn btn-primary">Cadastre-se</button>
                @else
                    <span style="margin-right: 10px;">👋 {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Sair</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <main style="padding-top: 90px;">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Easy Budget. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="{{ asset('js/EasyBudget.js') }}"></script>
</body>
</html>
