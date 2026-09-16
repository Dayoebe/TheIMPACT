    <nav class="app-nav" aria-label="Quick navigation">
        <a href="{{ route('home') }}#home" @if(request()->routeIs('home')) @click="open = false; currentSection = 'home'" :class="{ 'is-current': currentSection === 'home' }" :aria-current="currentSection === 'home' ? 'location' : null" @endif>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1Z"/></svg>
            <span>Home</span>
        </a>
        <a href="{{ route('about') }}" @if(request()->routeIs('about')) class="is-current" aria-current="page" @endif>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="7" r="3"/><path d="M3 21v-3a6 6 0 0 1 12 0v3M16 4a3 3 0 0 1 0 6m2 4a5 5 0 0 1 3 4v3"/></svg>
            <span>About</span>
        </a>
        <a href="{{ route('home') }}#vision" @if(request()->routeIs('home')) @click="open = false; currentSection = 'vision'" :class="{ 'is-current': currentSection === 'vision' }" :aria-current="currentSection === 'vision' ? 'location' : null" @endif>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
            <span>Vision</span>
        </a>
        <a href="{{ route('home') }}#focus" @if(request()->routeIs('home')) @click="open = false; currentSection = 'focus'" :class="{ 'is-current': currentSection === 'focus' }" :aria-current="currentSection === 'focus' ? 'location' : null" @endif>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
            <span>Focus</span>
        </a>
        <a href="{{ route('home') }}#journey" @if(request()->routeIs('home')) @click="open = false; currentSection = 'journey'" :class="{ 'is-current': currentSection === 'journey' }" :aria-current="currentSection === 'journey' ? 'location' : null" @endif>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="5" cy="18" r="2"/><circle cx="19" cy="6" r="2"/><path d="M7 18h8a4 4 0 0 0 0-8H9a4 4 0 0 1 0-8h6"/></svg>
            <span>Journey</span>
        </a>
    </nav>
