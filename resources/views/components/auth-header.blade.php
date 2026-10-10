@props(['title', 'subtitle'])
<div class="auth-header">
    <a href="{{ route('home') }}" class="auth-logo">
        <i class="ri-book-open-fill"></i> Smart Noted
    </a>
    <h2>{{ $title }}</h2>
    <p>{{ $subtitle }}</p>
</div>