@props(['number', 'label', 'color' => null])
@php
    $colorClass = match($color) {
        '#10b981' => 'border-emerald',
        '#f59e0b' => 'border-amber',
        '#6366f1' => 'border-indigo',
        default => '',
    };
@endphp
<div class="stat-card-simple {{ $colorClass }}">
    <h3>{{ $number }}</h3>
    <p>{{ $label }}</p>
</div>