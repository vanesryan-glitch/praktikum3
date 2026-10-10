@props(['href', 'icon', 'title'])
<a href="{{ $href }}" class="feature-box">
    <i class="{{ $icon }}"></i>
    <h4>{{ $title }}</h4>
    <p>{{ $slot }}</p>
</a>