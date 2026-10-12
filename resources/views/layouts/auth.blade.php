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
<body class="member-auth-body min-h-screen bg-paper">
    <header class="member-auth-header flex min-h-20 items-center justify-between gap-5 border-b border-line px-5 lg:px-[max(20px,calc((100vw-1240px)/2))]">
        <a href="{{ route('home') }}" aria-label="THE IMPACT home"><x-brand-logo /></a>
        <a href="{{ route('home') }}">Back to website <span aria-hidden="true">↗</span></a>
    </header>
    <main class="member-auth-main grid min-h-[calc(100vh-78px)] lg:grid-cols-[.9fr_1.1fr]">
        <section class="member-auth-intro hidden flex-col justify-center bg-ink px-12 py-15 text-white lg:flex [&_h1]:my-5 [&_h1]:max-w-175 [&_h1]:text-[clamp(56px,6vw,84px)] [&_.eyebrow]:text-gold">
            <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">THE IMPACT network</p>
            <h1>@yield('heading')</h1>
            <p>@yield('introduction')</p>
            <div class="member-auth-principles mt-9 flex flex-wrap gap-5 border-t border-white/15 pt-5">
                <span>Faith</span><span>Leadership</span><span>Service</span><span>Transformation</span>
            </div>
        </section>
        <section class="member-auth-panel grid place-items-center px-5 py-11">
            @yield('content')
        </section>
    </main>
</body>
</html>
