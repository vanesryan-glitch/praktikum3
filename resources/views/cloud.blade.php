@extends('layouts.app')

@section('title', 'Cloud')

@section('content')
<div class="container">
    <div class="hero">
        <h2>Ruang Cloud</h2>
        <p>Simpan, kelola, dan akses file belajarmu dengan aman dan mudah.</p>
        <button class="upload-btn">
            <i class="ri-cloud-upload-line"></i> Upload File
        </button>
    </div>

    <div class="item">
        <div class="storage-header">
            <strong><i class="ri-database-2-line"></i>Penyimpanan Digunakan</strong>
            <span>{{ $used }} GB / {{ $total }} GB</span>
        </div>
        <div class="progress-container">
            <div class="progress-bar" data-percent="{{ $percent }}"></div>
        </div>
        <p class="storage-desc">{{ $total - $used }} GB tersisa dari total {{ $total }} GB</p>
    </div>

    <div class="cloud-grid">
        @forelse ($files as [$title, $type, $size, $icon, $class])
            <div class="cloud-card">
                <div class="file-icon-wrap {{ $class }}">
                    <i class="{{ $icon }}"></i>
                </div>
                <h4>{{ $title }}</h4>
                <p>{{ $type }} &bull; {{ $size }}</p>
                <div class="cloud-actions">
                    <button class="action-btn download">
                        <i class="ri-download-2-line"></i> Download
                    </button>
                    <button class="action-btn delete">
                        <i class="ri-delete-bin-6-line"></i>
                    </button>
                </div>
            </div>
        @empty
            <p class="cloud-empty-msg">Belum ada file tersimpan.</p>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    const pb = document.querySelector('.progress-bar');
    if (pb && pb.dataset.percent) pb.style.width = pb.dataset.percent + '%';
</script>
@endpush