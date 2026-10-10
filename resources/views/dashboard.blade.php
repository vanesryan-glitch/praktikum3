@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="welcome-section">
        <div class="welcome-text">
            <h2>Halo, {{ $name }}! 👋</h2>
            <p>Ayo lanjutkan belajarmu hari ini.</p>
        </div>

        <div class="header-actions">
            <div class="translate-center">
                <div class="translate-btn" id="translateBtn">
                    <i class="ri-translate-2"></i>
                </div>
                <div class="translate-dropdown" id="translateMenu">
                    <div class="translate-header">Pilih Bahasa</div>
                    @foreach ($languages as [$code, $flag, $label])
                        <div class="lang-item" onclick="alert('Bahasa diubah ke: {{ $code }}')">
                            <img src="https://flagcdn.com/w20/{{ $flag }}.png" alt="{{ $code }}">
                            <span>{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="notification-center">
                <div class="notif-btn" id="notifBtn">
                    <i class="ri-notification-3-line"></i>
                    @if (count($notifications) > 0)
                        <span class="notif-badge">3</span>
                    @endif
                </div>

                <div class="notif-dropdown" id="notifMenu">
                    <div class="notif-header">Notifikasi Terbaru</div>
                    @forelse ($notifications as [$icon, $before, $bold, $after, $time])
                        <div class="notif-item">
                            <i class="{{ $icon }}"></i>
                            <div class="notif-content">
                                <p>{{ $before }}<strong>{{ $bold }}</strong>{{ $after }}</p>
                                <span>{{ $time }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="notif-item">
                            <div class="notif-content"><p>Belum ada notifikasi.</p></div>
                        </div>
                    @endforelse
                    <div class="notif-footer">
                        <a href="#">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-row">
        @foreach ($stats as [$number, $label, $color])
            <x-stat-card :number="$number" :label="$label" :color="$loop->first ? null : $color" />
        @endforeach
    </div>

    <h3 class="dashboard-section-title">Akses Cepat</h3>
    <div class="feature-grid">
        @foreach ($shortcuts as [$routeName, $icon, $title, $desc])
            <x-feature-box :href="route($routeName)" :icon="$icon" :title="$title">{{ $desc }}</x-feature-box>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const menus = [['translateBtn', 'translateMenu'], ['notifBtn', 'notifMenu']];
    menus.forEach(([btnId, menuId]) => {
        document.getElementById(btnId).addEventListener('click', () => {
            menus.forEach(([, other]) => {
                if (other !== menuId) document.getElementById(other).classList.remove('show');
            });
            document.getElementById(menuId).classList.toggle('show');
        });
    });
</script>
@endpush