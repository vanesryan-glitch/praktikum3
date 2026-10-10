@php
    $menu = [
        ['home', 'Home'],
        ['dashboard', 'Dashboard'],
        ['calendar', 'Kalender'],
        ['cloud', 'Cloud'],
        ['collaboration', 'Kolaborasi'],
        ['scan', 'Scan Tulis Tangan'],
    ];
@endphp
<nav>
    <a href="{{ route('home') }}" class="logo"><i class="ri-book-open-line"></i> Smart Noted</a>
    <ul class="navbar">
        @foreach ($menu as [$routeName, $label])
            <li>
                <a href="{{ route($routeName) }}" @if (request()->routeIs($routeName)) class="active" @endif>{{ $label }}</a>
            </li>
        @endforeach
    </ul>
    <div class="main-nav-btns">
        <a href="{{ route('profile') }}" class="cta">Profile</a>
    </div>
</nav>