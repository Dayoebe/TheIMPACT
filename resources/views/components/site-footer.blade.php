<footer class="site-footer">
    <div class="shell">
        <div class="footer-main"><a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><x-brand-logo /></a>
            <p>Christian Youth Leadership<br>& Public Impact Network</p>
            <nav aria-label="Footer navigation">
                @foreach(['about' => 'About', 'about.vision-mission' => 'Vision & Mission', 'leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)<a
                href="{{ route($routeName) }}">{{ $label }}</a>@endforeach</nav>
        </div>
        <p class="imagery-note">Imagery is AI-generated to illustrate our values.</p>
        <div class="footer-bottom"><span>© {{ date('Y') }} <a href="https://dayoebe.github.io" target="_blank" rel="noopener noreferrer">Wireless Terminal</a>. All rights reserved.</span><span>Faith →
                Leadership → Transformation</span><a href="#main">Back to top ↑</a></div>
    </div>
</footer>
