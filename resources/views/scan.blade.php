@extends('layouts.app')

@section('title', 'Scan Tulis Tangan')

@section('content')
<div class="scan-container">
    <header class="scan-header">
        <h2>Scan Tulis Tangan</h2>
        <p>Ubah catatan tulisan tanganmu menjadi teks digital dengan mudah.</p>
    </header>

    <section class="camera-section">
        <div class="video-wrapper placeholder">
            <i class="ri-camera-switch-line"></i>
        </div>

        <div class="scan-actions">
            <button class="btn" onclick="alert('Fitur Scan sedang dalam pengembangan (Hanya UI)')">
                <i class="ri-camera-line"></i> Ambil & Scan
            </button>
        </div>
    </section>

    <section class="history-section">
        <h3>Riwayat Hasil Scan</h3>
        <div class="file-list">
            @forelse ($scans as $file)
                <div class="file-card">
                    <div class="file-info">
                        <i class="ri-file-text-line"></i>
                        <div class="file-details">
                            <h4>{{ $file['name'] }}</h4>
                            <p>{{ $file['date'] }}</p>
                        </div>
                    </div>
                    <div class="scan-actions scan-actions-center">
                        <button class="download-btn-sm" data-name="{{ $file['name'] }}" data-content="{{ $file['content'] }}">
                            <i class="ri-download-2-line"></i> Unduh
                        </button>
                    </div>
                </div>
            @empty
                <p class="history-empty-msg">
                    Belum ada riwayat scan.
                </p>
            @endforelse
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.download-btn-sm').forEach(btn => btn.addEventListener('click', () => {
        const element = document.createElement('a');
        const blob = new Blob([btn.dataset.content], { type: 'text/plain' });
        element.href = URL.createObjectURL(blob);
        element.download = btn.dataset.name;
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    }));
</script>
@endpush