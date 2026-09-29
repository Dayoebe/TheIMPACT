<header class="site-header" @keydown.escape.window="if (open) { open = false; $refs.menuToggle.focus(); }" @click.outside="open = false">
    <div class="shell header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><x-brand-logo /></a>
        <nav class="desktop-nav" aria-label="Main navigation">
            @foreach(['about' => 'About', 'leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)
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
        @foreach(['home' => 'Home', 'about' => 'About THE IMPACT', 'about.vision-mission' => 'Vision & Mission', 'leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)
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
