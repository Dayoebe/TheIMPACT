<div {{ $attributes->class(['page']) }} x-data="{ open: false }" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false">
    <x-site-header />
    <main id="main">{{ $slot }}</main>
    <x-site-footer />
    <x-mobile-navigation />
</div>
