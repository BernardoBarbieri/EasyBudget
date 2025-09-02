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
        <div class="auth-buttons" id="authArea">
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
