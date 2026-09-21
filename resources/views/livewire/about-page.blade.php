<div class="page about-page" x-data="{ open: false }" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false">
    <x-site-header />

    <main id="main">
        <section class="about-hero">
            <div class="shell">
                <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span><span aria-current="page">About THE IMPACT</span></nav>
                <div class="about-hero-grid">
                    <div>
                        <p class="eyebrow section-label">ABOUT THE IMPACT</p>
                        <h1>A shared faith.<br>A public <em>purpose.</em></h1>
                        <p class="about-hero-lead">We connect Christian young leaders with the character, competence and courage to serve people and shape a better society.</p>
                        <a href="#who-we-are" class="button button-dark">Get to know us <span aria-hidden="true">↓</span></a>
                    </div>
                    <figure class="about-portrait">
                        <img src="{{ asset('images/leadership-circle-960.webp') }}" srcset="{{ asset('images/leadership-circle-480.webp') }} 480w, {{ asset('images/leadership-circle-960.webp') }} 960w, {{ asset('images/leadership-circle-1536.webp') }} 1536w" sizes="(min-width: 1024px) 46vw, calc(100vw - 40px)" width="1536" height="1024" fetchpriority="high" decoding="async" alt="AI-generated illustration of young African adults discussing ideas around a table with notebooks and a Bible.">
                        <figcaption><x-icon name="connect" /><span>Rooted in Christ. Connected by purpose.</span></figcaption>
                    </figure>
                </div>
                <nav class="about-contents" aria-label="On this page">
                    @foreach (['who-we-are' => 'Who we are', 'why-we-exist' => 'Why we exist', 'the-problem' => 'The problem', 'our-philosophy' => 'Our philosophy', 'our-approach' => 'Our approach', 'our-difference' => 'Our difference'] as $id => $label)
                        <a href="#{{ $id }}"><span>0{{ $loop->iteration }}</span>{{ $label }}<span aria-hidden="true">↗</span></a>
                    @endforeach
                </nav>
            </div>
        </section>

        <section id="who-we-are" class="shell section about-editorial">
            <div><p class="eyebrow section-label">01 / WHO WE ARE</p><h2>A network of people.<br><em>A commitment to serve.</em></h2></div>
            <div class="about-prose"><p class="lead">THE IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation across Africa.</p><p>We bring faith and public responsibility together. Our shared conviction is that following Christ should shape how we lead, the decisions we make and the way we respond to the needs of others.</p><p>We seek to connect young Christians who want to develop their abilities and put them to work in communities, institutions and public life. Character, competence and courage are central to the kind of leadership we want to nurture.</p></div>
        </section>

        <section id="why-we-exist" class="about-purpose-section">
            <div class="shell section about-editorial">
                <div><p class="eyebrow section-label">02 / WHY THE IMPACT EXISTS</p><h2>Conviction needs<br><em>a way into action.</em></h2><span class="about-feature-icon"><x-icon name="faith" /></span></div>
                <div class="about-prose"><p class="lead">We exist to help young Christians turn a sense of calling into meaningful contribution.</p><p>A desire to make a difference needs direction, preparation and people to walk alongside us. THE IMPACT brings these priorities together through a mission to identify, connect, equip, mentor and deploy young leaders.</p><p>Our vision is to become Africa’s leading network for developing Christ-centred young leaders who shape institutions, influence public policy and build solutions that transform communities and nations.</p><a href="{{ route('about.vision-mission') }}" class="underlined-link">Read our Vision &amp; Mission <span aria-hidden="true">↗</span></a><p>That vision begins with a practical question: how can our faith, abilities and opportunities serve the people around us?</p></div>
            </div>
        </section>

        <section id="the-problem" class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">03 / THE PROBLEM WE’RE ADDRESSING</p><h2>The gap between potential<br>and <em>prepared leadership.</em></h2></div><p>We focus on the barriers that can keep a willingness to serve from becoming an informed, sustained contribution.</p></div>
            <div class="about-card-grid">
                @foreach ([['compass', 'Conviction without direction', 'A strong sense of purpose can remain an intention when there is no clear path into service. Young leaders need ways to understand where their abilities meet real needs.'], ['equip', 'Passion without preparation', 'Good intentions alone cannot resolve complex public challenges. Responsible leadership also calls for practical skills, sound judgement and a willingness to learn.'], ['connect', 'Potential without connection', 'Growing alone can make it harder to find guidance, exchange ideas and sustain a commitment to service. Relationships and mentorship matter.']] as [$icon, $heading, $copy])
                    <article class="about-info-card"><span class="purpose-icon"><x-icon :name="$icon" /></span><h3>{{ $heading }}</h3><p>{{ $copy }}</p></article>
                @endforeach
            </div>
        </section>

        <section id="our-philosophy" class="about-philosophy-section">
            <div class="shell section">
                <div class="section-heading"><div><p class="eyebrow section-label">04 / OUR PHILOSOPHY</p><h2>Faith is the foundation.<br><em>Transformation is the aim.</em></h2></div><p>Six connected ideas guide how we think about leadership and the contribution it should make.</p></div>
                <x-philosophy />
            </div>
        </section>

        <section id="our-approach" class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">05 / OUR APPROACH</p><h2>Recognise the calling.<br><em>Prepare for the work.</em></h2></div><p>Our mission follows five connected steps. Each keeps personal growth tied to responsibility beyond ourselves.</p></div>
            <div class="about-approach-grid">
                <figure class="community-visual">
                    <img src="{{ asset('images/community-service-960.webp') }}" srcset="{{ asset('images/community-service-480.webp') }} 480w, {{ asset('images/community-service-960.webp') }} 960w, {{ asset('images/community-service-1536.webp') }} 1536w" sizes="(min-width: 1024px) 44vw, calc(100vw - 40px)" width="1536" height="1024" loading="lazy" decoding="async" alt="AI-generated illustration of young African volunteers planting a tree in a community garden.">
                    <figcaption><x-icon name="growth" /><span>Growth finds its purpose in contribution.</span></figcaption>
                </figure>
                <ol class="about-steps">
                    @foreach ([['identify', 'Identify', 'Recognise young Christians with the desire and character to take responsibility and make a difference.'], ['connect', 'Connect', 'Bring people together around shared faith, mutual encouragement and a commitment to public impact.'], ['equip', 'Equip', 'Develop the understanding and capabilities needed to engage with challenges and contribute practical solutions.'], ['mentor', 'Mentor', 'Make guidance, reflection and learning from others part of the journey towards responsible leadership.'], ['deploy', 'Deploy', 'Put preparation into practice through service, problem-solving and contribution in communities and institutions.']] as [$icon, $heading, $copy])
                        <li><span class="approach-icon"><x-icon :name="$icon" /></span><div><h3>{{ $heading }}</h3><p>{{ $copy }}</p></div></li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section id="our-difference" class="about-difference-section">
            <div class="shell section">
                <div class="section-heading"><div><p class="eyebrow section-label">06 / WHAT MAKES THE NETWORK DIFFERENT</p><h2>The commitments<br>that <em>define us.</em></h2></div><p>Our identity comes from bringing these priorities together in one shared purpose.</p></div>
                <div class="about-card-grid about-difference-grid">
                    @foreach ([['faith', 'Christ-centred, publicly engaged', 'Faith shapes our character and informs our responsibility in governance, public policy, institutions and everyday community life.'], ['leadership', 'Character and competence together', 'We value both the person a leader becomes and the ability they develop. Integrity, preparation and courage belong together.'], ['connect', 'Relationships that support growth', 'Connection and mentorship are part of our mission. We want young leaders to learn with others and contribute to one another’s development.'], ['service', 'Africa-focused, service-driven', 'Our vision is rooted in the future of African communities and nations. We orient leadership towards people’s needs and the work of building useful solutions.']] as [$icon, $heading, $copy])
                        <article class="about-info-card"><span class="purpose-icon"><x-icon :name="$icon" /></span><h3>{{ $heading }}</h3><p>{{ $copy }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="shell closing-section"><span class="closing-star"><x-icon name="growth" /></span><p class="eyebrow">PURPOSE, PUT INTO PRACTICE</p><h2>See where our<br><em>convictions lead.</em></h2><a href="{{ route('programmes.index') }}" class="button button-dark">Explore our programmes <span aria-hidden="true">↗</span></a></section>
    </main>

    <x-site-footer />
    <x-mobile-navigation />
</div>
