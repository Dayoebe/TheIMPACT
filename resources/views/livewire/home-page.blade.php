<div class="page" x-data="{
    open: false,
    currentSection: 'home',
    syncSection() {
        const sections = ['home', 'about', 'vision', 'focus', 'journey'];
        const threshold = document.querySelector('.site-header').getBoundingClientRect().height + 120;
        this.currentSection = sections.reduce((current, id) => document.getElementById(id).getBoundingClientRect().top <= threshold ? id : current, 'home');
    }
}" x-init="$nextTick(() => syncSection())" @scroll.window.throttle.100ms="syncSection()" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false; syncSection()">
    <header class="site-header" @keydown.escape.window="if (open) { open = false; $refs.menuToggle.focus(); }" @click.outside="open = false">
        <div class="shell header-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><span class="brand-symbol" aria-hidden="true">↗</span><span><small>THE</small>IMPACT<span class="brand-dot">.</span></span></a>
            <nav class="desktop-nav" aria-label="Main navigation">
                <a href="#about">Who we are</a><a href="#focus">Our focus</a><a href="#journey">The journey</a>
            </nav>
            <a href="#vision" class="button button-dark header-cta">Discover our vision <span aria-hidden="true">↗</span></a>
            <button type="button" class="menu-button" x-ref="menuToggle" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation"><span x-text="open ? 'Close −' : 'Menu +'">Menu +</span></button>
        </div>
        <nav id="mobile-navigation" x-cloak x-show="open" x-transition class="mobile-nav" aria-label="Mobile navigation" @click="if ($event.target.closest('a')) open = false">
            <a href="#about">Who we are</a><a href="#vision">Our vision</a><a href="#focus">Our focus</a><a href="#journey">The journey</a>
        </nav>
    </header>

    <main id="main">
        <section id="home" class="hero">
            <div class="shell hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow"><x-icon name="faith" class="tiny-cross" /> Faith-led. Service-driven. Africa-focused.</p>
                    <h1>Rooted in faith.<br>Built for <em>impact.</em></h1>
                    <p class="hero-description">A generation of Christ-centred young leaders. Equipped to serve. Ready to shape the future of our communities and nations.</p>
                    <div class="hero-actions"><a href="#about" class="button button-gold">Discover The IMPACT <span aria-hidden="true">↗</span></a><a href="#journey" class="text-link">Explore the journey <span aria-hidden="true">→</span></a></div>
                    <div class="hero-footnote"><span class="line"></span><span>Christian Youth Leadership<br>& Public Impact Network</span></div>
                </div>
                <figure class="hero-visual">
                    <div class="hero-photo-frame">
                        <img src="{{ asset('images/leadership-circle-960.webp') }}"
                            srcset="{{ asset('images/leadership-circle-480.webp') }} 480w, {{ asset('images/leadership-circle-960.webp') }} 960w, {{ asset('images/leadership-circle-1536.webp') }} 1536w"
                            sizes="(min-width: 1024px) 46vw, (min-width: 768px) 640px, calc(100vw - 40px)"
                            width="1536" height="1024" fetchpriority="high" decoding="async"
                            alt="AI-generated illustration of young African adults sharing ideas around a table, with notebooks and a Bible.">
                        <span class="photo-badge"><x-icon name="connect" /> A shared calling</span>
                    </div>
                    <figcaption class="hero-photo-caption">
                        <span class="caption-symbol"><x-icon name="faith" /></span>
                        <div><span class="eyebrow">Faith brings us together.</span><p>Purpose moves us forward.</p></div>
                        <x-icon name="growth" class="caption-growth" />
                    </figcaption>
                </figure>
            </div>
            <div class="shell hero-bottom"><span>Conviction becomes contribution.</span><a href="#about">SCROLL TO EXPLORE <span aria-hidden="true">↓</span></a></div>
        </section>

        <section class="philosophy" aria-label="Our main philosophy"><div class="shell philosophy-inner"><p class="eyebrow">Our philosophy</p><ol>@foreach (['Faith', 'Leadership', 'Competence', 'Service', 'Influence', 'Transformation'] as $value)<li>{{ $value }} @unless($loop->last)<span aria-hidden="true">↗</span>@endunless</li>@endforeach</ol></div></section>

        <section id="about" class="section shell about-grid">
            <div class="about-intro"><p class="eyebrow section-label">01 / WHO WE ARE</p><h2>Faith is our foundation.<br><em>Society is our field.</em></h2>
                <figure class="community-visual">
                    <img src="{{ asset('images/community-service-960.webp') }}"
                        srcset="{{ asset('images/community-service-480.webp') }} 480w, {{ asset('images/community-service-960.webp') }} 960w, {{ asset('images/community-service-1536.webp') }} 1536w"
                        sizes="(min-width: 1024px) 44vw, (min-width: 768px) 640px, calc(100vw - 40px)"
                        width="1536" height="1024" loading="lazy" decoding="async"
                        alt="AI-generated illustration of young African volunteers planting a tree together in a community garden.">
                    <figcaption><x-icon name="growth" /><span>Conviction grows through service.</span></figcaption>
                </figure>
            </div>
            <div class="about-copy"><p class="lead">We believe young Christians have a vital role to play in the future of Africa.</p><p>The IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation.</p><p>We bring faith and public responsibility together, connecting a generation with the purpose, competence and courage to turn conviction into meaningful contribution.</p><a href="#focus" class="underlined-link">See where we focus <span aria-hidden="true">↗</span></a></div>
        </section>

        <section id="vision" class="shell vision-grid">
            <article class="vision-card"><span class="purpose-icon"><x-icon name="compass" /></span><p class="eyebrow">THE FUTURE WE SEE</p><span class="card-number" aria-hidden="true">01</span><h2>Our vision<span>.</span></h2><p>To become Africa's leading network for developing Christ-centred young leaders who shape institutions, influence public policy and build solutions that transform communities and nations.</p><div class="card-caption"><span aria-hidden="true">↗</span> A vision for Africa. A calling for a generation.</div></article>
            <article class="mission-card"><span class="purpose-icon"><x-icon name="deploy" /></span><p class="eyebrow">THE WORK WE ARE CALLED TO DO</p><span class="card-number" aria-hidden="true">02</span><h2>Our mission<span>.</span></h2><p>The IMPACT exists to identify, connect, equip, mentor and deploy young Christians with the character, competence and courage to provide solutions, influence public policy, serve their communities and lead transformational change in society.</p><div class="card-caption"><span aria-hidden="true">↗</span> Purpose, put into practice.</div></article>
        </section>

        <section id="focus" class="section shell" x-data="{ active: 0 }">
            <div class="section-heading"><div><p class="eyebrow section-label">02 / OUR FOCUS</p><h2>Conviction.<br><em>With real-world purpose.</em></h2></div><p>Five connected areas. One shared commitment: to serve people and contribute to a better society.</p></div>
            @php
                $focusAreas = [
                    ['Governance', 'Lead with integrity.', 'Responsible leadership begins with character. Our focus is on young Christians who bring integrity, accountability and a spirit of service to institutions and public life.', 'Character in public life'],
                    ['Public policy', 'Bring solutions to the table.', 'We believe faith-informed values and practical competence can help young leaders engage thoughtfully with public policy and the decisions that shape everyday life.', 'Ideas that serve people'],
                    ['Leadership', 'Grow into your calling.', 'Leadership is a responsibility to develop. Through connection, equipping and mentorship, our mission is to help young Christians grow in character, competence and courage.', 'Purpose meets preparation'],
                    ['Service', 'Start where you are.', 'Meaningful contribution begins with people. Serving communities puts our convictions into practice and keeps leadership rooted in the needs of others.', 'People at the centre'],
                    ['Societal transformation', 'Build for lasting change.', 'Our vision reaches beyond individual success to solutions that strengthen communities, shape institutions and contribute to the transformation of nations.', 'A future shaped together'],
                ];
            @endphp
            <div class="focus-grid">
                <div class="focus-tabs" role="tablist" aria-label="Our focus areas" aria-orientation="vertical">
                    @foreach ($focusAreas as $area)
                        <button id="focus-tab-{{ $loop->index }}" type="button" role="tab" aria-controls="focus-panel-{{ $loop->index }}" :aria-selected="active === {{ $loop->index }}" :tabindex="active === {{ $loop->index }} ? 0 : -1" :class="{ 'is-active': active === {{ $loop->index }} }" @click="active = {{ $loop->index }}" @keydown.arrow-down.prevent="active = (active + 1) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.arrow-up.prevent="active = (active + 4) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.home.prevent="active = 0; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.end.prevent="active = 4; $nextTick(() => $el.parentElement.children[active].focus())"><x-icon :name="['governance', 'policy', 'leadership', 'service', 'growth'][$loop->index]" class="tab-icon" />{{ $area[0] }}<span class="tab-arrow" aria-hidden="true">↗</span></button>
                    @endforeach
                </div>
                <div class="focus-content">
                    @foreach ($focusAreas as $area)
                        <article id="focus-panel-{{ $loop->index }}" role="tabpanel" aria-labelledby="focus-tab-{{ $loop->index }}" tabindex="0" x-show="active === {{ $loop->index }}" @if(!$loop->first) x-cloak @endif>
                            <div class="focus-icon"><x-icon :name="['governance', 'policy', 'leadership', 'service', 'growth'][$loop->index]" /></div><p class="eyebrow">{{ $area[3] }}</p><h3>{{ $area[1] }}</h3><p>{{ $area[2] }}</p><a href="#journey" class="underlined-link">Our path to impact <span aria-hidden="true">→</span></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="journey" class="journey-section"><div class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">03 / THE JOURNEY</p><h2>From a sense of calling<br>to a life of <em>contribution.</em></h2></div><p>Our mission follows a clear path: identify, connect, equip, mentor and deploy.</p></div>
            <ol class="journey-grid">
                @foreach ([['Identify', 'Recognise purpose', 'Identify young Christians with the character and desire to make a difference.'], ['Connect', 'Find your people', 'Connect young leaders through a shared commitment to faith and public impact.'], ['Equip', 'Build competence', 'Equip leaders with the understanding and capabilities to provide solutions.'], ['Mentor', 'Grow with guidance', 'Mentor emerging leaders as they develop the courage and character to serve.'], ['Deploy', 'Put faith into action', 'Deploy leaders to serve their communities and contribute to transformational change.']] as $step)
                    <li><div class="step-top"><span>0{{ $loop->iteration }}</span><x-icon :name="['identify', 'connect', 'equip', 'mentor', 'deploy'][$loop->index]" /></div><h3>{{ $step[0] }}</h3><p class="step-label">{{ $step[1] }}</p><p>{{ $step[2] }}</p></li>
                @endforeach
            </ol>
        </div></section>

        <section class="shell closing-section"><span class="closing-star"><x-icon name="growth" /></span><p class="eyebrow">THE FUTURE CALLS FOR MORE OF US</p><h2>A grounded faith.<br>A prepared generation.<br><em>A transformed society.</em></h2><a href="#vision" class="button button-dark">Return to our vision <span aria-hidden="true">↗</span></a></section>
    </main>
    <footer class="site-footer"><div class="shell"><div class="footer-main"><a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><span class="brand-symbol" aria-hidden="true">↗</span><span><small>THE</small>IMPACT<span class="brand-dot">.</span></span></a><p>Christian Youth Leadership<br>& Public Impact Network</p><nav aria-label="Footer navigation"><a href="#about">Who we are</a><a href="#focus">Our focus</a><a href="#journey">The journey</a></nav></div><p class="imagery-note">Imagery is AI-generated to illustrate our values.</p><div class="footer-bottom"><span>© {{ date('Y') }} The IMPACT. All rights reserved.</span><span>Faith → Leadership → Transformation</span><a href="#main">Back to top ↑</a></div></div></footer>
    <nav class="app-nav" aria-label="Quick navigation">
        <a href="#home" @click="open = false; currentSection = 'home'" :class="{ 'is-current': currentSection === 'home' }" :aria-current="currentSection === 'home' ? 'location' : null">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1Z"/></svg>
            <span>Home</span>
        </a>
        <a href="#about" @click="open = false; currentSection = 'about'" :class="{ 'is-current': currentSection === 'about' }" :aria-current="currentSection === 'about' ? 'location' : null">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="7" r="3"/><path d="M3 21v-3a6 6 0 0 1 12 0v3M16 4a3 3 0 0 1 0 6m2 4a5 5 0 0 1 3 4v3"/></svg>
            <span>About</span>
        </a>
        <a href="#vision" @click="open = false; currentSection = 'vision'" :class="{ 'is-current': currentSection === 'vision' }" :aria-current="currentSection === 'vision' ? 'location' : null">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
            <span>Vision</span>
        </a>
        <a href="#focus" @click="open = false; currentSection = 'focus'" :class="{ 'is-current': currentSection === 'focus' }" :aria-current="currentSection === 'focus' ? 'location' : null">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
            <span>Focus</span>
        </a>
        <a href="#journey" @click="open = false; currentSection = 'journey'" :class="{ 'is-current': currentSection === 'journey' }" :aria-current="currentSection === 'journey' ? 'location' : null">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="5" cy="18" r="2"/><circle cx="19" cy="6" r="2"/><path d="M7 18h8a4 4 0 0 0 0-8H9a4 4 0 0 1 0-8h6"/></svg>
            <span>Journey</span>
        </a>
    </nav>
</div>
