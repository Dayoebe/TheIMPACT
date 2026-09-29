<header class="site-header" @keydown.escape.window="if (open) { open = false; $refs.menuToggle.focus(); }" @click.outside="open = false">
    <div class="shell header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><x-brand-logo /></a>
        <nav class="desktop-nav" aria-label="Main navigation">
            <details class="nav-dropdown" @if(request()->routeIs('about', 'about.*')) data-current="true" @endif>
                <summary @if(request()->routeIs('about', 'about.*')) aria-current="page" @endif>About <span aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif><strong>About overview</strong><small>Who we are and why we exist</small></a>
                    <a href="{{ route('about.vision-mission') }}" @if(request()->routeIs('about.vision-mission')) aria-current="page" @endif><strong>Vision & Mission</strong><small>Our direction and philosophy</small></a>
                </div>
            </details>
            @foreach(['leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)
                <a href="{{ route($routeName) }}" @if(request()->routeIs($routeName) || ($routeName === 'programmes.index' && request()->routeIs('programmes.show'))) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>
        <div class="header-account">
            @guest
                <a href="{{ route('login') }}" class="header-login">Log in</a>
                <a href="{{ route('register') }}" class="button button-dark header-signup">Sign up <span aria-hidden="true">↗</span></a>
            @else
                @if(auth()->user()->is_super_admin)
                    <a href="{{ route('admin.dashboard') }}" class="header-login">Dashboard</a>
                @else
                    <span class="header-member-name">{{ str(auth()->user()->name)->before(' ') }}</span>
                @endif
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="header-logout">Log out</button></form>
            @endguest
        </div>
        <button type="button" class="menu-button" x-ref="menuToggle" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation"><span x-text="open ? 'Close −' : 'Menu +'">Menu +</span></button>
    </div>
    <nav id="mobile-navigation" x-cloak x-show="open" x-transition class="mobile-nav" aria-label="Mobile navigation" @click="if ($event.target.closest('a')) open = false">
        <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home<span aria-hidden="true">↗</span></a>
        <p class="mobile-nav-group">About</p>
        @foreach(['about' => 'About overview', 'about.vision-mission' => 'Vision & Mission'] as $routeName => $label)
            <a class="mobile-nav-child" href="{{ route($routeName) }}" @if(request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}<span aria-hidden="true">↗</span></a>
        @endforeach
        @foreach(['leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)
            <a href="{{ route($routeName) }}" @if(request()->routeIs($routeName) || ($routeName === 'programmes.index' && request()->routeIs('programmes.show'))) aria-current="page" @endif>{{ $label }}<span aria-hidden="true">↗</span></a>
        @endforeach
        <div class="mobile-auth-links">
            @guest
                <a href="{{ route('login') }}">Log in<span aria-hidden="true">→</span></a>
                <a href="{{ route('register') }}" class="mobile-signup">Create account<span aria-hidden="true">↗</span></a>
            @else
                @if(auth()->user()->is_super_admin)<a href="{{ route('admin.dashboard') }}">Dashboard<span aria-hidden="true">↗</span></a>@endif
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Log out <span aria-hidden="true">→</span></button></form>
            @endguest
        </div>
    </nav>
</header>
