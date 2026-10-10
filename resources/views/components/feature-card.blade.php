@props(['icon', 'title'])
<div class="feature-card">
    <div class="feature-icon"><i class="{{ $icon }}"></i></div>
    <h4>{{ $title }}</h4>
    <p>{{ $slot }}</p>
</div>