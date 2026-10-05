<div class="page" x-data="{ open: false }" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false">
    <x-site-header />

    <main id="main">
        <section id="home" class="hero">
            <div class="shell hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow"><x-icon name="faith" class="tiny-cross" /> {{ $content['hero']['eyebrow'] }}</p>
                    <h1>{{ $content['hero']['title_line_one'] }}<br>{{ $content['hero']['title_line_two'] }} <em>{{ $content['hero']['title_emphasis'] }}</em></h1>
                    <p class="hero-description">{{ $content['hero']['description'] }}</p>
                    <div class="hero-actions"><a href="{{ route('about') }}" class="button button-gold">{{ $content['hero']['primary_button_label'] }} <span aria-hidden="true">↗</span></a><a href="#journey" class="text-link">{{ $content['hero']['secondary_button_label'] }} <span aria-hidden="true">→</span></a></div>
                    <div class="hero-footnote"><span class="line"></span><span>{{ $content['hero']['footnote_line_one'] }}<br>{{ $content['hero']['footnote_line_two'] }}</span></div>
                </div>
                <figure class="hero-visual">
                    <div class="hero-photo-frame">
                        <img src="{{ $heroImageUrl }}"
                            sizes="(min-width: 1024px) 46vw, (min-width: 768px) 640px, calc(100vw - 40px)"
                            width="1536" height="1024" fetchpriority="high" decoding="async"
                            alt="{{ $content['hero']['image_alt'] }}">
                        <span class="photo-badge"><x-icon name="connect" /> {{ $content['hero']['badge'] }}</span>
                    </div>
                    <figcaption class="hero-photo-caption">
                        <span class="caption-symbol"><x-icon name="faith" /></span>
                        <div><span class="eyebrow">{{ $content['hero']['caption_eyebrow'] }}</span><p>{{ $content['hero']['caption_title'] }}</p></div>
                        <x-icon name="growth" class="caption-growth" />
                    </figcaption>
                </figure>
            </div>
            <div class="shell hero-bottom"><span>{{ $content['hero']['bottom_statement'] }}</span><a href="#about">SCROLL TO EXPLORE <span aria-hidden="true">↓</span></a></div>
        </section>

        <section class="philosophy" aria-label="Our main philosophy"><div class="shell philosophy-inner"><p class="eyebrow">Our philosophy</p><ol>@foreach ($content['philosophy'] as $value)<li>{{ $value }} @unless($loop->last)<span aria-hidden="true">↗</span>@endunless</li>@endforeach</ol></div></section>

        <section id="about" class="section shell about-grid">
            <div class="about-intro"><p class="eyebrow section-label">{{ $content['about']['label'] }}</p><h2>{{ $content['about']['title_line_one'] }}<br><em>{{ $content['about']['title_emphasis'] }}</em></h2>
                <figure class="community-visual">
                    <img src="{{ $aboutImageUrl }}"
                        sizes="(min-width: 1024px) 44vw, (min-width: 768px) 640px, calc(100vw - 40px)"
                        width="1536" height="1024" loading="lazy" decoding="async"
                        alt="{{ $content['about']['image_alt'] }}">
                    <figcaption><x-icon name="growth" /><span>{{ $content['about']['image_caption'] }}</span></figcaption>
                </figure>
            </div>
            <div class="about-copy"><p class="lead">{{ $content['about']['lead'] }}</p>@foreach($content['about']['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach<a href="{{ route('about') }}" class="underlined-link">{{ $content['about']['link_label'] }} <span aria-hidden="true">↗</span></a></div>
        </section>

        <section class="founder-section" aria-labelledby="founder-heading">
            <div class="shell founder-grid">
                <figure class="founder-portrait">
                    <img src="{{ $founderImageUrl }}" width="960" height="1280" loading="lazy" decoding="async" alt="{{ $content['founder']['image_alt'] }}">
                    <figcaption><span>{{ $content['founder']['name'] }}</span><strong>{{ $content['founder']['role'] }}</strong></figcaption>
                </figure>
                <div class="founder-copy">
                    <p class="eyebrow">{{ $content['founder']['eyebrow'] }}</p>
                    <h2 id="founder-heading">{{ $content['founder']['title_line_one'] }}<br><em>{{ $content['founder']['title_emphasis'] }}</em></h2>
                    <p>{{ $content['founder']['description'] }}</p>
                    <a href="{{ route('leadership') }}" class="underlined-link">{{ $content['founder']['link_label'] }} <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section id="vision" class="shell vision-grid">
            <article class="vision-card"><span class="purpose-icon"><x-icon name="compass" /></span><p class="eyebrow">{{ $content['vision']['eyebrow'] }}</p><span class="card-number" aria-hidden="true">01</span><h2>{{ $content['vision']['title'] }}<span>.</span></h2><p>{{ $content['vision']['statement'] }}</p><div class="card-caption"><span aria-hidden="true">↗</span> {{ $content['vision']['caption'] }}</div></article>
            <article class="mission-card"><span class="purpose-icon"><x-icon name="deploy" /></span><p class="eyebrow">{{ $content['mission']['eyebrow'] }}</p><span class="card-number" aria-hidden="true">02</span><h2>{{ $content['mission']['title'] }}<span>.</span></h2><p>{{ $content['mission']['statement'] }}</p><div class="card-caption"><span aria-hidden="true">↗</span> {{ $content['mission']['caption'] }}</div></article>
        </section>

        <section id="focus" class="section shell" x-data="{ active: 0 }">
            <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['focus']['label'] }}</p><h2>{{ $content['focus']['title_line_one'] }}<br><em>{{ $content['focus']['title_emphasis'] }}</em></h2></div><p>{{ $content['focus']['introduction'] }}</p></div>
            <div class="focus-grid">
                <div class="focus-tabs" role="tablist" aria-label="Our focus areas" aria-orientation="vertical">
                    @foreach ($content['focus']['areas'] as $area)
                        <button id="focus-tab-{{ $loop->index }}" type="button" role="tab" aria-controls="focus-panel-{{ $loop->index }}" :aria-selected="active === {{ $loop->index }}" :tabindex="active === {{ $loop->index }} ? 0 : -1" :class="{ 'is-active': active === {{ $loop->index }} }" @click="active = {{ $loop->index }}" @keydown.arrow-down.prevent="active = (active + 1) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.arrow-up.prevent="active = (active + 4) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.home.prevent="active = 0; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.end.prevent="active = 4; $nextTick(() => $el.parentElement.children[active].focus())"><x-icon :name="$area['icon']" class="tab-icon" />{{ $area['name'] }}<span class="tab-arrow" aria-hidden="true">↗</span></button>
                    @endforeach
                </div>
                <div class="focus-content">
                    @foreach ($content['focus']['areas'] as $area)
                        <article id="focus-panel-{{ $loop->index }}" role="tabpanel" aria-labelledby="focus-tab-{{ $loop->index }}" tabindex="0" x-show="active === {{ $loop->index }}" @if(!$loop->first) x-cloak @endif>
                            <div class="focus-icon"><x-icon :name="$area['icon']" /></div><p class="eyebrow">{{ $area['eyebrow'] }}</p><h3>{{ $area['title'] }}</h3><p>{{ $area['description'] }}</p><a href="{{ route('programmes.index') }}" class="underlined-link">{{ $content['focus']['link_label'] }} <span aria-hidden="true">→</span></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="journey" class="journey-section"><div class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['journey']['label'] }}</p><h2>{{ $content['journey']['title_line_one'] }}<br>{{ $content['journey']['title_line_two'] }} <em>{{ $content['journey']['title_emphasis'] }}</em></h2></div><p>{{ $content['journey']['introduction'] }}</p></div>
            <ol class="journey-grid">
                @foreach ($content['journey']['steps'] as $step)
                    <li><div class="step-top"><span>0{{ $loop->iteration }}</span><x-icon :name="$step['icon']" /></div><h3>{{ $step['name'] }}</h3><p class="step-label">{{ $step['label'] }}</p><p>{{ $step['description'] }}</p></li>
                @endforeach
            </ol>
        </div></section>

        <section id="programmes" class="shell section homepage-programmes">
            <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['programmes']['label'] }}</p><h2>{{ $content['programmes']['title_line_one'] }}<br><em>{{ $content['programmes']['title_emphasis'] }}</em></h2></div><p>{{ $content['programmes']['introduction'] }}</p></div>
            <div class="homepage-programme-grid">
                @foreach($programmes as $programme)
                    <article class="homepage-programme-card">
                        <div><span class="purpose-icon"><x-icon :name="$programme->icon" /></span><span class="eyebrow">{{ $programme->category }}</span></div>
                        <h3><a href="{{ route('programmes.show', $programme->slug) }}">{{ $programme->name }}</a></h3>
                        <p>{{ $programme->summary }}</p>
                        <a href="{{ route('programmes.show', $programme->slug) }}" class="underlined-link" aria-label="Explore {{ $programme->name }}">Explore pathway <span aria-hidden="true">↗</span></a>
                    </article>
                @endforeach
            </div>
            <div class="homepage-section-action"><a href="{{ route('programmes.index') }}" class="button button-dark">{{ $content['programmes']['button_label'] }} <span aria-hidden="true">↗</span></a></div>
        </section>

        <section class="homepage-mentorship">
            <div class="shell homepage-mentorship-grid">
                <div class="homepage-mentorship-mark" aria-hidden="true"><x-icon name="mentor" /><span>Experience</span><span>Potential</span></div>
                <div>
                    <p class="eyebrow">{{ $content['mentorship']['eyebrow'] }}</p>
                    <h2>{{ $content['mentorship']['title_line_one'] }}<br><em>{{ $content['mentorship']['title_emphasis'] }}</em></h2>
                    <p class="lead">{{ $content['mentorship']['lead'] }}</p>
                    <p>{{ $content['mentorship']['description'] }}</p>
                    <a href="{{ route('mentorship') }}" class="button button-gold">{{ $content['mentorship']['button_label'] }} <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="shell section homepage-participate">
            <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['participate']['label'] }}</p><h2>{{ $content['participate']['title_line_one'] }}<br><em>{{ $content['participate']['title_emphasis'] }}</em></h2></div><p>{{ $content['participate']['introduction'] }}</p></div>
            <div class="homepage-pathway-grid">
                @foreach($content['participate']['pathways'] as $pathway)
                    @php($pathwayRoute = ['programmes.index', 'mentorship', 'about.vision-mission'][$loop->index])
                    <article class="homepage-pathway-card"><span class="purpose-icon"><x-icon :name="$pathway['icon']" /></span><span class="card-number" aria-hidden="true">0{{ $loop->iteration }}</span><h3>{{ $pathway['title'] }}</h3><p>{{ $pathway['description'] }}</p><a href="{{ route($pathwayRoute) }}" class="underlined-link">{{ $pathway['button_label'] }} <span aria-hidden="true">↗</span></a></article>
                @endforeach
            </div>
        </section>

        <section class="shell closing-section"><span class="closing-star"><x-icon name="growth" /></span><p class="eyebrow">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br>{{ $content['closing']['title_line_two'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('about.vision-mission') }}" class="button button-dark">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
    </main>
    <x-site-footer />
    <x-mobile-navigation />
</div>
