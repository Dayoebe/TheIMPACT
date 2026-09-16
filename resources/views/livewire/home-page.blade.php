<div class="page" x-data="{
    open: false,
    currentSection: 'home',
    syncSection() {
        const sections = ['home', 'about', 'vision', 'focus', 'journey'];
        const threshold = document.querySelector('.site-header').getBoundingClientRect().height + 120;
        const section = sections.reduce((current, id) => document.getElementById(id).getBoundingClientRect().top <= threshold ? id : current, 'home');
        this.currentSection = section === 'about' ? 'home' : section;
    }
}" x-init="$nextTick(() => syncSection())" @scroll.window.throttle.100ms="syncSection()" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false; syncSection()">
    <x-site-header />

    <main id="main">
        <section id="home" class="hero">
            <div class="shell hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow"><x-icon name="faith" class="tiny-cross" /> Faith-led. Service-driven. Africa-focused.</p>
                    <h1>Rooted in faith.<br>Built for <em>impact.</em></h1>
                    <p class="hero-description">A generation of Christ-centred young leaders. Equipped to serve. Ready to shape the future of our communities and nations.</p>
                    <div class="hero-actions"><a href="{{ route('about') }}" class="button button-gold">Discover The IMPACT <span aria-hidden="true">↗</span></a><a href="#journey" class="text-link">Explore the journey <span aria-hidden="true">→</span></a></div>
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
            <div class="about-copy"><p class="lead">We believe young Christians have a vital role to play in the future of Africa.</p><p>The IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation.</p><p>We bring faith and public responsibility together, connecting a generation with the purpose, competence and courage to turn conviction into meaningful contribution.</p><a href="{{ route('about') }}" class="underlined-link">More about THE IMPACT <span aria-hidden="true">↗</span></a></div>
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
    <x-site-footer />
    <x-mobile-navigation />
</div>
