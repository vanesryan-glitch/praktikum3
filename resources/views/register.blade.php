@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="auth-screen">
    <div class="auth-card">
        <x-auth-header title="Buat Akun" subtitle="Daftar untuk mulai mencatat dengan cerdas" />

        <form action="{{ route('login') }}">
            @foreach ([
                ['fullname', 'Nama Lengkap', 'text', 'ri-user-3-line', 'Nama lengkap Anda'],
                ['email', 'Email', 'email', 'ri-mail-line', 'nama@email.com'],
                ['password', 'Password', 'password', 'ri-lock-line', 'Minimal 8 karakter'],
            ] as [$id, $label, $type, $icon, $placeholder])
                <div class="form-group">
                    <label for="{{ $id }}">{{ $label }}</label>
                    <div class="input-wrapper">
                        <i class="{{ $icon }}"></i>
                        <input type="{{ $type }}" id="{{ $id }}" placeholder="{{ $placeholder }}" required>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn-submit">Daftar Akun</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="social-login">
            <button class="btn-social">
                <i class="ri-google-fill"></i> Google
            </button>
        </div>

        <p class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </p>
    </div>
</div>
@endsection