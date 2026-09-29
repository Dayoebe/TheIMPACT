<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#102a43">
    <title>@yield('title') — THE IMPACT</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="member-auth-body">
    <header class="member-auth-header">
        <a href="{{ route('home') }}" aria-label="THE IMPACT home"><x-brand-logo /></a>
        <a href="{{ route('home') }}">Back to website <span aria-hidden="true">↗</span></a>
    </header>
    <main class="member-auth-main">
        <section class="member-auth-intro">
            <p class="eyebrow">THE IMPACT network</p>
            <h1>@yield('heading')</h1>
            <p>@yield('introduction')</p>
            <div class="member-auth-principles">
                <span>Faith</span><span>Leadership</span><span>Service</span><span>Transformation</span>
            </div>
        </section>
        <section class="member-auth-panel">
            @yield('content')
        </section>
    </main>
</body>
</html>
