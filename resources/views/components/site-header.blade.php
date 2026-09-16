    <header class="site-header" @keydown.escape.window="if (open) { open = false; $refs.menuToggle.focus(); }" @click.outside="open = false">
        <div class="shell header-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><span class="brand-symbol" aria-hidden="true">↗</span><span><small>THE</small>IMPACT<span class="brand-dot">.</span></span></a>
            <nav class="desktop-nav" aria-label="Main navigation">
                <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>Who we are</a><a href="{{ route('home') }}#focus">Our focus</a><a href="{{ route('home') }}#journey">The journey</a>
            </nav>
            <a href="{{ route('home') }}#vision" class="button button-dark header-cta">Discover our vision <span aria-hidden="true">↗</span></a>
            <button type="button" class="menu-button" x-ref="menuToggle" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation"><span x-text="open ? 'Close −' : 'Menu +'">Menu +</span></button>
        </div>
        <nav id="mobile-navigation" x-cloak x-show="open" x-transition class="mobile-nav" aria-label="Mobile navigation" @click="if ($event.target.closest('a')) open = false">
            <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>Who we are</a><a href="{{ route('home') }}#vision">Our vision</a><a href="{{ route('home') }}#focus">Our focus</a><a href="{{ route('home') }}#journey">The journey</a>
        </nav>
    </header>
