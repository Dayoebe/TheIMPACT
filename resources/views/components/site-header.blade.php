<header class="site-header sticky top-0 z-40 border-b border-line bg-paper lg:relative [&_nav_>_a]:inline-flex [&_nav_>_a]:min-h-11 [&_nav_>_a]:items-center [&_nav_>_a]:text-[13px] [&_nav_>_a]:font-semibold [&_a[aria-current='page']]:text-[#95682f] [&_a[aria-current='page']]:underline [&_a[aria-current='page']]:underline-offset-8" @keydown.escape.window="if (open) { open = false; $refs.menuToggle.focus(); }" @click.outside="open = false">
    <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] header-inner flex min-h-18 items-center justify-between gap-4 lg:min-h-25">
        <a href="{{ route('home') }}" class="brand inline-flex min-h-12 shrink-0 items-center" aria-label="The IMPACT home"><x-brand-logo /></a>
        <nav class="desktop-nav hidden items-center gap-5 lg:flex" aria-label="Main navigation">
            <details class="nav-dropdown relative [&_summary]:inline-flex [&_summary]:min-h-11 [&_summary]:items-center [&_summary]:text-[13px] [&_summary]:font-semibold [&_summary]:cursor-pointer [&_summary]:list-none [&_summary]:gap-2 [&[open]_.nav-dropdown-menu]:grid" @if(request()->routeIs('about', 'about.*')) data-current="true" @endif>
                <summary class="[&::-webkit-details-marker]:hidden" @if(request()->routeIs('about', 'about.*')) aria-current="page" @endif>About <span aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown-menu absolute top-[calc(100%+8px)] left-1/2 z-60 hidden w-65 -translate-x-1/2 border border-line bg-paper p-2 shadow-xl group-open:grid [&_a]:grid [&_a]:gap-1 [&_a]:px-3.5 [&_a]:py-3 [&_a:hover]:bg-[#f1e7ec] [&_strong]:text-xs [&_small]:text-[9px] [&_small]:leading-normal [&_small]:text-muted">
                    <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif><strong>About overview</strong><small>Who we are and why we exist</small></a>
                    <a href="{{ route('about.vision-mission') }}" @if(request()->routeIs('about.vision-mission')) aria-current="page" @endif><strong>Vision & Mission</strong><small>Our direction and philosophy</small></a>
                    <a href="{{ route('about.philosophy-focus') }}" @if(request()->routeIs('about.philosophy-focus')) aria-current="page" @endif><strong>Philosophy & Focus Areas</strong><small>What guides us and where we contribute</small></a>
                </div>
            </details>
            <a href="{{ route('leadership') }}" @if(request()->routeIs('leadership')) aria-current="page" @endif>Leadership</a>
            <details class="nav-dropdown relative [&_summary]:inline-flex [&_summary]:min-h-11 [&_summary]:items-center [&_summary]:text-[13px] [&_summary]:font-semibold [&_summary]:cursor-pointer [&_summary]:list-none [&_summary]:gap-2 [&[open]_.nav-dropdown-menu]:grid" @if(request()->routeIs('programmes.*')) data-current="true" @endif>
                <summary class="[&::-webkit-details-marker]:hidden" @if(request()->routeIs('programmes.*')) aria-current="page" @endif>Programmes <span aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown-menu absolute top-[calc(100%+8px)] left-1/2 z-60 hidden w-65 -translate-x-1/2 border border-line bg-paper p-2 shadow-xl group-open:grid [&_a]:grid [&_a]:gap-1 [&_a]:px-3.5 [&_a]:py-3 [&_a:hover]:bg-[#f1e7ec] [&_strong]:text-xs [&_small]:text-[9px] [&_small]:leading-normal [&_small]:text-muted">
                    <a href="{{ route('programmes.index') }}" @if(request()->routeIs('programmes.index', 'programmes.show')) aria-current="page" @endif><strong>Programme Directory</strong><small>Explore every learning pathway</small></a>
                    <a href="{{ route('programmes.cohorts') }}" @if(request()->routeIs('programmes.cohorts')) aria-current="page" @endif><strong>Cohorts & Registration</strong><small>Schedules and application availability</small></a>
                </div>
            </details>
            <a href="{{ route('mentorship') }}" @if(request()->routeIs('mentorship')) aria-current="page" @endif>Mentorship</a>
        </nav>
        <div class="header-account hidden items-center gap-3.5 lg:flex">
            @guest
                <a href="{{ route('login') }}" class="header-login inline-flex min-h-11 items-center text-[11px] font-bold text-plum">Log in</a>
                <a href="{{ route('register') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d] header-signup min-h-11 px-4 py-2.5 text-[11px]">Sign up <span aria-hidden="true">↗</span></a>
            @else
                @if(auth()->user()->is_super_admin)
                    <a href="{{ route('admin.dashboard') }}" class="header-login inline-flex min-h-11 items-center text-[11px] font-bold text-plum">Dashboard</a>
                @else
                    <span class="header-member-name inline-flex min-h-11 items-center text-[11px] font-bold">{{ str(auth()->user()->name)->before(' ') }}</span>
                @endif
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="header-logout inline-flex min-h-11 items-center text-[11px] font-bold text-muted">Log out</button></form>
            @endguest
        </div>
        <button type="button" class="menu-button inline-flex min-h-11 min-w-20 items-center justify-center rounded-xl border border-line bg-surface px-3 text-xs lg:hidden" x-ref="menuToggle" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation"><span x-text="open ? 'Close −' : 'Menu +'">Menu +</span></button>
    </div>
    <nav id="mobile-navigation" x-cloak x-show="open" class="mobile-nav max-h-[calc(100dvh-160px)] overflow-y-auto border-t border-line px-5 pt-2 pb-5 shadow-xl lg:hidden [&_>_a]:flex [&_>_a]:min-h-12 [&_>_a]:w-full [&_>_a]:items-center [&_>_a]:justify-between [&_>_a]:border-b [&_>_a]:border-line [&_>_a]:px-3 [&_>_a]:py-3 [&_>_a]:text-[13px] [&_>_a]:font-semibold animate__animated animate__fadeIn animate__faster" aria-label="Mobile navigation" @click="if ($event.target.closest('a')) open = false">
        <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home<span aria-hidden="true">↗</span></a>
        <p class="mobile-nav-group mx-3 mt-3.5 mb-0.5 text-[9px] font-extrabold tracking-[1.6px] text-plum uppercase">About</p>
        @foreach(['about' => 'About overview', 'about.vision-mission' => 'Vision & Mission', 'about.philosophy-focus' => 'Philosophy & Focus Areas'] as $routeName => $label)
            <a class="mobile-nav-child bg-surface pl-7!" href="{{ route($routeName) }}" @if(request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}<span aria-hidden="true">↗</span></a>
        @endforeach
        <a href="{{ route('leadership') }}" @if(request()->routeIs('leadership')) aria-current="page" @endif>Leadership<span aria-hidden="true">↗</span></a>
        <p class="mobile-nav-group mx-3 mt-3.5 mb-0.5 text-[9px] font-extrabold tracking-[1.6px] text-plum uppercase">Programmes</p>
        <a class="mobile-nav-child bg-surface pl-7!" href="{{ route('programmes.index') }}" @if(request()->routeIs('programmes.index', 'programmes.show')) aria-current="page" @endif>Programme Directory<span aria-hidden="true">↗</span></a>
        <a class="mobile-nav-child bg-surface pl-7!" href="{{ route('programmes.cohorts') }}" @if(request()->routeIs('programmes.cohorts')) aria-current="page" @endif>Cohorts & Registration<span aria-hidden="true">↗</span></a>
        <a href="{{ route('mentorship') }}" @if(request()->routeIs('mentorship')) aria-current="page" @endif>Mentorship<span aria-hidden="true">↗</span></a>
        <div class="mobile-auth-links mt-2.5 border-t border-line pt-2.5 [&_a]:flex [&_a]:min-h-12 [&_a]:w-full [&_a]:items-center [&_a]:justify-between [&_a]:border-b [&_a]:border-line [&_a]:px-3 [&_a]:py-3 [&_a]:text-[13px] [&_a]:font-semibold [&_button]:flex [&_button]:min-h-12 [&_button]:w-full [&_button]:items-center [&_button]:justify-between [&_button]:border-b [&_button]:border-line [&_button]:px-3 [&_button]:py-3 [&_button]:text-[13px] [&_button]:font-semibold">
            @guest
                <a href="{{ route('login') }}">Log in<span aria-hidden="true">→</span></a>
                <a href="{{ route('register') }}" class="mobile-signup mt-1.5 rounded-xl bg-ink text-white">Create account<span aria-hidden="true">↗</span></a>
            @else
                @if(auth()->user()->is_super_admin)<a href="{{ route('admin.dashboard') }}">Dashboard<span aria-hidden="true">↗</span></a>@endif
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Log out <span aria-hidden="true">→</span></button></form>
            @endguest
        </div>
    </nav>
</header>
