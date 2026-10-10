@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="auth-screen">
    <div class="auth-card">
        <x-auth-header title="Selamat Datang" subtitle="Masuk ke akun Anda untuk melanjutkan" />

        <form action="{{ route('dashboard') }}">
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <i class="ri-mail-line"></i>
                    <input type="email" id="email" placeholder="nama@email.com" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="ri-lock-line"></i>
                    <input type="password" id="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="auth-utils">
                <label class="remember-me">
                    <input type="checkbox"> Ingat saya
                </label>
                <a href="#" class="forgot-pw">Lupa password?</a>
            </div>

            <button type="submit" class="btn-submit">Masuk</button>
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
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
</div>
@endsection