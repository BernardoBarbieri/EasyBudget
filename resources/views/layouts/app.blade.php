<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Easy Budget') }}</title>

    {{-- Evite Vite aqui se você não estiver usando o build --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Opcional: um CSS leve para telas do Breeze --}}
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin:0; background:#f7f7fb; color:#1f2937; }
        header { background:#111827; color:#fff; padding:12px 0; }
        header .container { max-width: 1100px; margin:0 auto; padding:0 16px; display:flex; align-items:center; justify-content:space-between; }
        main { max-width: 1100px; margin: 24px auto; padding: 0 16px; }
        a { color: inherit; text-decoration: none; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div style="display:flex; align-items:center; gap:10px;">
                <i class="fas fa-calendar-alt"></i>
                <strong>Easy Budget</strong>
            </div>
            <nav>
                <a href="{{ url('/') }}">Home</a>
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>
