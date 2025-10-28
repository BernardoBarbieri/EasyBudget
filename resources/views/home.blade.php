@extends('layouts.app')

@section('title', 'Easy Budget - Organização de Eventos')

@section('content')
<style>
    /* ======== GLOBAL ======== */
    body {
        background-color: #f8f9ff;
        color: #222;
        font-family: 'Poppins', sans-serif;
    }

    /* ======== HERO ======== */
    .hero {
        background: linear-gradient(135deg, #6C63FF, #4A47D5, #7C83FD);
        color: white;
        padding: 120px 0;
        text-align: center;
        border-radius: 0 0 60px 60px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: "";
        position: absolute;
        top: -100px;
        left: -200px;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        filter: blur(120px);
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 40px;
    }

    .hero .btn-primary {
        background: white;
        color: #4A47D5;
        font-weight: 600;
        padding: 14px 40px;
        border-radius: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .hero .btn-primary:hover {
        transform: translateY(-4px);
        background: #f4f4ff;
    }

    /* ======== FEATURES ======== */
    .features {
        margin-top: 100px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 35px;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        width: 290px;
        padding: 35px 25px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    .feature-card i {
        font-size: 2.8rem;
        color: #4A47D5;
        margin-bottom: 18px;
    }

    .feature-card h4 {
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
    }

    .feature-card p {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.5;
    }

    /* ======== SHOWCASE ======== */
    .showcase {
        margin: 100px auto;
        text-align: center;
        max-width: 850px;
        opacity: 0;
        transform: translateY(40px);
        animation: fadeInUp 1.5s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .showcase h2 {
        font-weight: 700;
        color: #2d2b7c;
        margin-bottom: 18px;
        font-size: 1.9rem;
    }

    .showcase p {
        color: #555;
        font-size: 1.05rem;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .showcase img {
        width: 80%;
        max-width: 700px;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.8s ease;
    }

    .showcase img:hover {
        transform: scale(1.03);
    }

    .showcase .btn-primary {
        background: #4A47D5;
        color: white;
        font-weight: 600;
        padding: 12px 35px;
        border-radius: 40px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 71, 213, 0.3);
    }

    .showcase .btn-primary:hover {
        background: #6C63FF;
        transform: scale(1.05);
    }

    /* ======== CTA ======== */
    .cta-section {
        margin: 100px auto 80px;
        text-align: center;
        background: linear-gradient(135deg, #4A47D5, #6C63FF);
        color: white;
        border-radius: 30px;
        padding: 70px 20px;
        width: 85%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .cta-section h2 {
        font-weight: 700;
        font-size: 1.9rem;
        margin-bottom: 10px;
    }

    .cta-section p {
        font-size: 1.05rem;
        opacity: 0.9;
        margin-bottom: 25px;
    }

    .cta-section .btn-light {
        background: white;
        color: #4A47D5;
        border-radius: 40px;
        padding: 12px 35px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .cta-section .btn-light:hover {
        background: #f3f3f3;
        transform: scale(1.07);
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.3rem;
        }
        .hero p {
            font-size: 1rem;
        }
        .features {
            gap: 20px;
        }
        .feature-card {
            width: 90%;
        }
        .showcase img {
            width: 95%;
        }
    }
</style>

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <h1>Transforme seus planos em eventos inesquecíveis ✨</h1>
        <p>Gerencie tudo com facilidade — do orçamento aos convidados — em uma plataforma inteligente e moderna.</p>
        <a href="{{ route('events.index') }}" class="btn btn-primary">Explorar Eventos</a>
    </div>
</section>

{{-- FEATURES --}}
<section class="features container">
    <div class="feature-card">
        <i class="fas fa-calendar-check"></i>
        <h4>Crie e Gerencie</h4>
        <p>Cadastre eventos com poucos cliques e tenha controle total de cada detalhe em tempo real.</p>
    </div>

    <div class="feature-card">
        <i class="fas fa-wallet"></i>
        <h4>Controle Financeiro</h4>
        <p>Acompanhe seus gastos e receitas em tempo real com relatórios claros e automáticos.</p>
    </div>

    <div class="feature-card">
        <i class="fas fa-users"></i>
        <h4>Lista de Convidados</h4>
        <p>Gerencie confirmações e mantenha o controle das presenças de forma simples e eficiente.</p>
    </div>

    <div class="feature-card">
        <i class="fas fa-chart-line"></i>
        <h4>Relatórios Visuais</h4>
        <p>Visualize métricas e resultados com gráficos dinâmicos e relatórios em PDF personalizados.</p>
    </div>
</section>

{{-- SHOWCASE --}}
<section class="showcase">
    <h2>Crie momentos que se tornam memórias eternas 💫</h2>
    <p>O <strong>Easy Budget</strong> é o seu aliado para transformar sonhos em experiências reais.  
       Planeje com praticidade, controle seus orçamentos e viva o prazer de ver tudo acontecer com organização e estilo. 🎉</p>
    <img src="https://images.unsplash.com/photo-1560184897-77c5e3a3b6db?auto=format&fit=crop&w=1000&q=80" 
         alt="Planejamento de evento moderno e elegante">
    <br><br>
    <a href="{{ route('register') }}" class="btn btn-primary">Começar Agora</a>
</section>

{{-- CTA --}}
<section class="cta-section">
    <h2>Comece a planejar seu próximo evento agora mesmo 🎯</h2>
    <p>Cadastre-se gratuitamente e leve sua organização de eventos para o próximo nível.</p>
    <a href="{{ route('register') }}" class="btn btn-light">Criar Conta Grátis</a>
</section>
@endsection

