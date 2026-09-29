<div class="page about-page" x-data="{ open: false }" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false">
    <x-site-header />

    <main id="main">
        <section class="about-hero">
            <div class="shell">
                <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span><span aria-current="page">About THE IMPACT</span></nav>
                <div class="about-hero-grid">
                    <div>
                        <p class="eyebrow section-label">{{ $content['hero']['eyebrow'] }}</p>
                        <h1>{{ $content['hero']['title_line_one'] }}<br>{{ $content['hero']['title_line_two'] }} <em>{{ $content['hero']['title_emphasis'] }}</em></h1>
                        <p class="about-hero-lead">{{ $content['hero']['lead'] }}</p>
                        <a href="#who-we-are" class="button button-dark">{{ $content['hero']['button_label'] }} <span aria-hidden="true">↓</span></a>
                    </div>
                    <figure class="about-portrait">
                        <img src="{{ $heroImageUrl }}" sizes="(min-width: 1024px) 46vw, calc(100vw - 40px)" width="1536" height="1024" fetchpriority="high" decoding="async" alt="{{ $content['hero']['image_alt'] }}">
                        <figcaption><x-icon name="connect" /><span>{{ $content['hero']['image_caption'] }}</span></figcaption>
                    </figure>
                </div>
                <nav class="about-contents" aria-label="On this page">
                    @foreach (array_combine(['who-we-are', 'why-we-exist', 'the-problem', 'our-philosophy', 'our-approach', 'our-difference'], $content['contents']) as $id => $label)
                        <a href="#{{ $id }}"><span>0{{ $loop->iteration }}</span>{{ $label }}<span aria-hidden="true">↗</span></a>
                    @endforeach
                </nav>
            </div>
        </section>

        <section id="who-we-are" class="shell section about-editorial">
            <div><p class="eyebrow section-label">{{ $content['who']['label'] }}</p><h2>{{ $content['who']['title_line_one'] }}<br><em>{{ $content['who']['title_emphasis'] }}</em></h2></div>
            <div class="about-prose"><p class="lead">{{ $content['who']['lead'] }}</p>@foreach($content['who']['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach</div>
        </section>

        <section id="why-we-exist" class="about-purpose-section">
            <div class="shell section about-editorial">
                <div><p class="eyebrow section-label">{{ $content['why']['label'] }}</p><h2>{{ $content['why']['title_line_one'] }}<br><em>{{ $content['why']['title_emphasis'] }}</em></h2><span class="about-feature-icon"><x-icon name="faith" /></span></div>
                <div class="about-prose"><p class="lead">{{ $content['why']['lead'] }}</p><p>{{ $content['why']['paragraphs'][0] }}</p><p>{{ $content['why']['paragraphs'][1] }}</p><a href="{{ route('about.vision-mission') }}" class="underlined-link">{{ $content['why']['link_label'] }} <span aria-hidden="true">↗</span></a><p>{{ $content['why']['paragraphs'][2] }}</p></div>
            </div>
        </section>

        <section id="the-problem" class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['problem']['label'] }}</p><h2>{{ $content['problem']['title_line_one'] }}<br><em>{{ $content['problem']['title_emphasis'] }}</em></h2></div><p>{{ $content['problem']['introduction'] }}</p></div>
            <div class="about-card-grid">
                @foreach ($content['problem']['cards'] as $card)
                    <article class="about-info-card"><span class="purpose-icon"><x-icon :name="$card['icon']" /></span><h3>{{ $card['title'] }}</h3><p>{{ $card['description'] }}</p></article>
                @endforeach
            </div>
        </section>

        <section id="our-philosophy" class="about-philosophy-section">
            <div class="shell section">
                <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['philosophy']['label'] }}</p><h2>{{ $content['philosophy']['title_line_one'] }}<br><em>{{ $content['philosophy']['title_emphasis'] }}</em></h2></div><p>{{ $content['philosophy']['introduction'] }}</p></div>
                <ol class="about-values">@foreach($content['philosophy']['values'] as $value)<li><span class="value-index">0{{ $loop->iteration }}</span><div><h3>{{ $value['name'] }}</h3><p>{{ $value['description'] }}</p></div></li>@endforeach</ol>
            </div>
        </section>

        <section id="our-approach" class="shell section">
            <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['approach']['label'] }}</p><h2>{{ $content['approach']['title_line_one'] }}<br><em>{{ $content['approach']['title_emphasis'] }}</em></h2></div><p>{{ $content['approach']['introduction'] }}</p></div>
            <div class="about-approach-grid">
                <figure class="community-visual">
                    <img src="{{ $approachImageUrl }}" sizes="(min-width: 1024px) 44vw, calc(100vw - 40px)" width="1536" height="1024" loading="lazy" decoding="async" alt="{{ $content['approach']['image_alt'] }}">
                    <figcaption><x-icon name="growth" /><span>{{ $content['approach']['image_caption'] }}</span></figcaption>
                </figure>
                <ol class="about-steps">
                    @foreach ($content['approach']['steps'] as $step)
                        <li><span class="approach-icon"><x-icon :name="$step['icon']" /></span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></div></li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section id="our-difference" class="about-difference-section">
            <div class="shell section">
                <div class="section-heading"><div><p class="eyebrow section-label">{{ $content['difference']['label'] }}</p><h2>{{ $content['difference']['title_line_one'] }}<br><em>{{ $content['difference']['title_emphasis'] }}</em></h2></div><p>{{ $content['difference']['introduction'] }}</p></div>
                <div class="about-card-grid about-difference-grid">
                    @foreach ($content['difference']['cards'] as $card)
                        <article class="about-info-card"><span class="purpose-icon"><x-icon :name="$card['icon']" /></span><h3>{{ $card['title'] }}</h3><p>{{ $card['description'] }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="shell closing-section"><span class="closing-star"><x-icon name="growth" /></span><p class="eyebrow">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('programmes.index') }}" class="button button-dark">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
    </main>

    <x-site-footer />
    <x-mobile-navigation />
</div>
