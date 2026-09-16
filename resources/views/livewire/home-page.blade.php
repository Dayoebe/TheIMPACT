<div>
    <header class="site-header" x-data="{ open: false }" @keydown.escape.window="open = false">
        <div class="shell flex items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><span class="brand-symbol" aria-hidden="true">↗</span><span><small>THE</small>IMPACT<span class="brand-dot">.</span></span></a>
            <nav class="hidden items-center gap-9 md:flex" aria-label="Main navigation">
                <a href="#about">Who we are</a><a href="#focus">Our focus</a><a href="#journey">The journey</a>
            </nav>
            <a href="#vision" class="button button-dark hidden sm:inline-flex">Discover our vision <span aria-hidden="true">↗</span></a>
            <button type="button" class="menu-button md:hidden" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation"><span x-text="open ? 'Close −' : 'Menu +'">Menu +</span></button>
        </div>
        <nav id="mobile-navigation" x-cloak x-show="open" x-transition class="mobile-nav md:hidden" aria-label="Mobile navigation" @click="if ($event.target.closest('a')) open = false">
            <a href="#about">Who we are</a><a href="#vision">Our vision</a><a href="#focus">Our focus</a><a href="#journey">The journey</a>
        </nav>
    </header>

    <main id="main">
        <section class="hero">
            <div class="shell hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow"><span class="tiny-cross" aria-hidden="true">✦</span> Faith-led. Service-driven. Africa-focused.</p>
                    <h1>Rooted in faith.<br>Built for <em>impact.</em></h1>
                    <p class="hero-description">A generation of Christ-centred young leaders. Equipped to serve. Ready to shape the future of our communities and nations.</p>
                    <div class="flex flex-wrap items-center gap-6"><a href="#about" class="button button-gold">Discover The IMPACT <span aria-hidden="true">↗</span></a><a href="#journey" class="text-link">Explore the journey <span aria-hidden="true">→</span></a></div>
                    <div class="hero-footnote"><span class="line"></span><span>Christian Youth Leadership<br>& Public Impact Network</span></div>
                </div>
                <div class="hero-art" aria-hidden="true">
                    <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
                    <span class="art-top">CHARACTER · COMPETENCE · COURAGE</span>
                    <div class="arch"><div class="arch-cross"></div><span class="arch-word">A higher<br><i>calling.</i></span><div class="steps"><span></span><span></span><span></span></div></div>
                    <span class="art-spark">✳</span><span class="art-label">FAITH IN ACTION</span><span class="art-index">01 / A GENERATION OF PURPOSE</span>
                </div>
            </div>
            <div class="shell hero-bottom"><span>Conviction becomes contribution.</span><a href="#about">SCROLL TO EXPLORE <span aria-hidden="true">↓</span></a></div>
        </section>

        <section class="philosophy" aria-label="Our main philosophy"><div class="shell philosophy-inner"><p class="eyebrow">Our philosophy</p><ol>@foreach (['Faith', 'Leadership', 'Competence', 'Service', 'Influence', 'Transformation'] as $value)<li>{{ $value }} @unless($loop->last)<span aria-hidden="true">↗</span>@endunless</li>@endforeach</ol></div></section>

        <section id="about" class="section shell about-grid">
            <div><p class="eyebrow section-label">01 / WHO WE ARE</p><h2>Faith is our foundation.<br><em>Society is our field.</em></h2></div>
            <div class="about-copy"><p class="lead">We believe young Christians have a vital role to play in the future of Africa.</p><p>The IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation.</p><p>We bring faith and public responsibility together, connecting a generation with the purpose, competence and courage to turn conviction into meaningful contribution.</p><a href="#focus" class="underlined-link">See where we focus <span aria-hidden="true">↗</span></a></div>
        </section>

        <section id="vision" class="shell vision-grid">
            <article class="vision-card"><p class="eyebrow">THE FUTURE WE SEE</p><span class="card-number" aria-hidden="true">01</span><h2>Our vision<span>.</span></h2><p>To become Africa's leading network for developing Christ-centred young leaders who shape institutions, influence public policy and build solutions that transform communities and nations.</p><div class="card-caption"><span aria-hidden="true">↗</span> A vision for Africa. A calling for a generation.</div></article>
            <article class="mission-card"><p class="eyebrow">THE WORK WE ARE CALLED TO DO</p><span class="card-number" aria-hidden="true">02</span><h2>Our mission<span>.</span></h2><p>The IMPACT exists to identify, connect, equip, mentor and deploy young Christians with the character, competence and courage to provide solutions, influence public policy, serve their communities and lead transformational change in society.</p><div class="card-caption"><span aria-hidden="true">↗</span> Purpose, put into practice.</div></article>
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
                        <button id="focus-tab-{{ $loop->index }}" type="button" role="tab" aria-controls="focus-panel-{{ $loop->index }}" :aria-selected="active === {{ $loop->index }}" :tabindex="active === {{ $loop->index }} ? 0 : -1" :class="{ 'is-active': active === {{ $loop->index }} }" @click="active = {{ $loop->index }}" @keydown.arrow-down.prevent="active = (active + 1) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.arrow-up.prevent="active = (active + 4) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.home.prevent="active = 0; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.end.prevent="active = 4; $nextTick(() => $el.parentElement.children[active].focus())"><span class="tab-number">0{{ $loop->iteration }}</span>{{ $area[0] }}<span class="tab-arrow" aria-hidden="true">↗</span></button>
                    @endforeach
                </div>
                <div class="focus-content">
                    @foreach ($focusAreas as $area)
                        <article id="focus-panel-{{ $loop->index }}" role="tabpanel" aria-labelledby="focus-tab-{{ $loop->index }}" tabindex="0" x-show="active === {{ $loop->index }}" @if(!$loop->first) x-cloak @endif>
                            <div class="focus-icon" aria-hidden="true">↗</div><p class="eyebrow">{{ $area[3] }}</p><h3>{{ $area[1] }}</h3><p>{{ $area[2] }}</p><a href="#journey" class="underlined-link">Our path to impact <span aria-hidden="true">→</span></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="journey" class="journey-section"><div class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">03 / THE JOURNEY</p><h2>From a sense of calling<br>to a life of <em>contribution.</em></h2></div><p>Our mission follows a clear path: identify, connect, equip, mentor and deploy.</p></div>
            <ol class="journey-grid">
                @foreach ([['Identify', 'Recognise purpose', 'Identify young Christians with the character and desire to make a difference.'], ['Connect', 'Find your people', 'Connect young leaders through a shared commitment to faith and public impact.'], ['Equip', 'Build competence', 'Equip leaders with the understanding and capabilities to provide solutions.'], ['Mentor', 'Grow with guidance', 'Mentor emerging leaders as they develop the courage and character to serve.'], ['Deploy', 'Put faith into action', 'Deploy leaders to serve their communities and contribute to transformational change.']] as $step)
                    <li><div class="step-top"><span>0{{ $loop->iteration }}</span><span aria-hidden="true">↗</span></div><h3>{{ $step[0] }}</h3><p class="step-label">{{ $step[1] }}</p><p>{{ $step[2] }}</p></li>
                @endforeach
            </ol>
        </div></section>

        <section class="shell closing-section"><span class="closing-star" aria-hidden="true">✳</span><p class="eyebrow">THE FUTURE CALLS FOR MORE OF US</p><h2>A grounded faith.<br>A prepared generation.<br><em>A transformed society.</em></h2><a href="#vision" class="button button-dark">Return to our vision <span aria-hidden="true">↗</span></a></section>
    </main>
    <footer class="site-footer"><div class="shell"><div class="footer-main"><a href="{{ route('home') }}" class="brand" aria-label="The IMPACT home"><span class="brand-symbol" aria-hidden="true">↗</span><span><small>THE</small>IMPACT<span class="brand-dot">.</span></span></a><p>Christian Youth Leadership<br>& Public Impact Network</p><nav aria-label="Footer navigation"><a href="#about">Who we are</a><a href="#focus">Our focus</a><a href="#journey">The journey</a></nav></div><div class="footer-bottom"><span>© {{ date('Y') }} The IMPACT. All rights reserved.</span><span>Faith → Leadership → Transformation</span><a href="#main">Back to top ↑</a></div></div></footer>
</div>
