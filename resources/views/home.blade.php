@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="home-page">
    <section class="hero-section">
        <div class="hero-content">
            <span class="section-tag">Platform Belajar All-in-One</span>
            <h1>Belajar Lebih <span>Cerdas</span> Bukan Lebih Keras.</h1>
            <p>Kelola catatan, tugas, dan kolaborasi tim dalam satu platform modern yang dirancang untuk meningkatkan produktivitas akademik Anda.</p>
            <div class="hero-btns">
                <a href="{{ route('dashboard') }}" class="btn-primary">Buka Dashboard</a>
                <a href="#features" class="btn-secondary">Pelajari Fitur</a>
            </div>
        </div>
        <div class="hero-visual">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Smart Noted Learning Interface" class="hero-img">
        </div>
    </section>

    <div class="trust-bar">
        @foreach ($stats as [$number, $label])
            <div class="trust-item"><h3>{{ $number }}</h3><p>{{ $label }}</p></div>
        @endforeach
    </div>

    <section id="features" class="features-section">
        <span class="section-tag">Kenapa Smart Noted?</span>
        <h2 class="section-title">Fitur Yang Membantu Anda Berhasil</h2>
        <div class="feature-grid">
            @foreach ($features as [$icon, $title, $desc])
                <x-feature-card :icon="$icon" :title="$title">{{ $desc }}</x-feature-card>
            @endforeach
        </div>
    </section>

    <section class="cta-banner">
        <div class="cta-box">
            <h2>Siap Untuk Meningkatkan Nilai Anda?</h2>
            <p>Bergabunglah dengan ribuan pelajar lainnya yang telah bertransformasi dengan Smart Noted.</p>
            <a href="{{ route('dashboard') }}" class="btn-primary">Mulai Belajar Gratis</a>
        </div>
    </section>
</div>
@endsection