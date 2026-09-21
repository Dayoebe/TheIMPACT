<header class="site-header" @keydown.escape.window="if (open) { open = false; $refs.menuToggle.focus(); }" @click.outside="open = false">
    <div class="shell header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><span class="brand-symbol" aria-hidden="true">↗</span><span><small>THE</small>IMPACT<span class="brand-dot">.</span></span></a>
        <nav class="desktop-nav" aria-label="Main navigation">
            @foreach(['about' => 'About', 'leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)
                <a href="{{ route($routeName) }}" @if(request()->routeIs($routeName) || ($routeName === 'programmes.index' && request()->routeIs('programmes.show'))) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>
        <a href="{{ route('about.vision-mission') }}" class="button button-dark header-cta" @if(request()->routeIs('about.vision-mission')) aria-current="page" @endif>Vision & Mission <span aria-hidden="true">↗</span></a>
        <button type="button" class="menu-button" x-ref="menuToggle" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation"><span x-text="open ? 'Close −' : 'Menu +'">Menu +</span></button>
    </div>
    <nav id="mobile-navigation" x-cloak x-show="open" x-transition class="mobile-nav" aria-label="Mobile navigation" @click="if ($event.target.closest('a')) open = false">
        @foreach(['home' => 'Home', 'about' => 'About THE IMPACT', 'about.vision-mission' => 'Vision & Mission', 'leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)
            <a href="{{ route($routeName) }}" @if(request()->routeIs($routeName) || ($routeName === 'programmes.index' && request()->routeIs('programmes.show'))) aria-current="page" @endif>{{ $label }}<span aria-hidden="true">↗</span></a>
        @endforeach
    </nav>
</header>
