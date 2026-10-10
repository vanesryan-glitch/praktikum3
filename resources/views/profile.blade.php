@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-hero"></div>

        <div class="profile-info-header">
            <div class="profile-avatar-wrapper">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=wincarlinn" alt="Avatar" class="profile-avatar">
            </div>
            <div class="profile-name-section">
                <h1>{{ $user['first'] }}</h1>
                <p>Mahasiswa • Akun terverifikasi</p>
            </div>
        </div>

        <div class="profile-body">
            <aside class="profile-nav">
                @foreach ($tabs as [$id, $icon, $label])
                    <button class="profile-nav-btn {{ $loop->first ? 'active' : '' }}">
                        <i class="{{ $icon }}"></i> {{ $label }}
                    </button>
                @endforeach
            </aside>

            <main class="profile-content">
                <div class="profile-content-box">
                    <form onsubmit="event.preventDefault(); alert('Berhasil Disimpan!');">
                        <div class="form-grid">
                            <div class="form-item">
                                <label>Nama Depan</label>
                                <input type="text" value="{{ $user['first'] }}">
                            </div>
                            <div class="form-item">
                                <label>Nama Belakang</label>
                                <input type="text" value="{{ $user['last'] }}">
                            </div>
                            <div class="form-item full">
                                <label>Alamat Email</label>
                                <input type="email" value="{{ $user['email'] }}" disabled>
                            </div>
                        </div>

                        <div class="profile-actions">
                            <button type="button" class="btn-ghost">Batal</button>
                            <button type="submit" class="btn-save">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const tabs = document.querySelectorAll('.profile-nav-btn');
    tabs.forEach(btn => btn.addEventListener('click', () => {
        tabs.forEach(t => t.classList.toggle('active', t === btn));
    }));
</script>
@endpush