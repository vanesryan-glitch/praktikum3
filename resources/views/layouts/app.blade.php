<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Noted') - Smart Noted</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @foreach (['main', 'index', 'mainhomepage', 'maindashboar', 'mainlogin', 'mainregister', 'mainkalender', 'maincloud', 'mainkolaborasi', 'mainscan'] as $css)
        <link rel="stylesheet" href="{{ asset('css/' . $css . '.css') }}">
    @endforeach
    @stack('styles')
</head>
<body>
    <div class="app-wrapper">
        <div class="app">
            @include('partials.navbar')
            <main class="main-content">
                @yield('content')
            </main>
            @include('partials.footer')
        </div>
    </div>
    @stack('scripts')
</body>
</html>