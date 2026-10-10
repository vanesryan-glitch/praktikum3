@extends('layouts.app')

@section('title', 'Kolaborasi')

@section('content')
<div class="meet-container">
    <div class="meet-left">
        <h1>Kolaborasi video & diskusi berkualitas tinggi untuk semua orang.</h1>
        <p>Smart Noted kini menyediakan ruang rapat yang aman, terintegrasi dengan catatan dan grup diskusi instan.</p>

        <div class="action-row">
            <button class="btn-new-meeting" id="openModal">
                <i class="ri-video-add-line"></i> Rapat baru
            </button>

            <div class="join-input-group">
                <i class="ri-keyboard-line"></i>
                <input type="text" id="meetingCode" placeholder="Masukkan kode atau tautan">
            </div>
            <button class="btn-join" id="joinBtn" disabled>Gabung</button>
        </div>
        <hr>
        <div class="learn-more">
            <a href="#">Pelajari lebih lanjut</a> tentang Smart Noted Kolaborasi.
        </div>
    </div>

    <div class="meet-right">
        <div class="feature-card">
            <div class="feature-icon-circle">
                <i class="ri-team-line"></i>
            </div>
            <h3>Dapatkan tautan yang dapat Anda bagikan</h3>
            <p>Klik <strong>Rapat baru</strong> untuk mendapatkan tautan yang dapat Anda kirimkan kepada orang yang ingin Anda ajak rapat.</p>
        </div>

        <div class="chat-teaser-panel">
            <div class="chat-teaser-header">
                <h4>Ruang Diskusi</h4>
                <span class="chat-tag">Fitur Unggulan</span>
            </div>
            @foreach ($chats as [$name, $initial, $text, $color])
                <div class="chat-msg-preview">
                    <div class="avatar {{ $color === '#10b981' ? 'avatar-emerald' : 'avatar-indigo' }}">{{ $initial }}</div>
                    <div class="chat-msg-content">
                        <div class="name">{{ $name }}</div>
                        <div class="text">{{ $text }}</div>
                    </div>
                </div>
            @endforeach
            <button class="btn-view-chat">
                <i class="ri-chat-3-line"></i> Masuk ke Grup Chat
            </button>
        </div>
    </div>

    <div id="modalOverlay" class="modal-overlay">
        <div class="modal-box">
            <h3>Buat Rapat Baru</h3>
            <button class="modal-btn" onclick="alert('Tautan disalin!')">
                <i class="ri-link"></i> Dapatkan tautan rapat
            </button>
            <button id="closeModal" class="modal-btn">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const overlay = document.getElementById('modalOverlay');
    const codeInput = document.getElementById('meetingCode');
    const joinBtn = document.getElementById('joinBtn');

    document.getElementById('openModal').addEventListener('click', () => overlay.classList.add('active'));
    document.getElementById('closeModal').addEventListener('click', () => overlay.classList.remove('active'));

    codeInput.addEventListener('input', () => {
        const filled = codeInput.value !== '';
        joinBtn.disabled = !filled;
    });
</script>
@endpush