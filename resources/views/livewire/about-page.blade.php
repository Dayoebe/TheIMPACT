<div class="page pb-20 lg:pb-0 about-page" x-data="{ open: false }" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false">
    <x-site-header />

    <main id="main">
        <section class="about-hero border-b border-line bg-surface pb-7">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))]">
                <nav class="breadcrumb flex flex-wrap items-center gap-3 py-3 text-[11px] text-muted" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span><span aria-current="page">About THE IMPACT</span></nav>
                <div class="about-hero-grid grid grid-cols-1 gap-7 py-4 pb-7 lg:grid-cols-2 lg:gap-16 lg:py-8 lg:pb-12">
                    <div>
                        <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['hero']['eyebrow'] }}</p>
                        <h1>{{ $content['hero']['title_line_one'] }}<br>{{ $content['hero']['title_line_two'] }} <em>{{ $content['hero']['title_emphasis'] }}</em></h1>
                        <p class="about-hero-lead mb-6 max-w-125 text-base leading-[1.85] text-muted">{{ $content['hero']['lead'] }}</p>
                        <a href="#who-we-are" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d]">{{ $content['hero']['button_label'] }} <span aria-hidden="true">↓</span></a>
                    </div>
                    <figure class="about-portrait self-center overflow-hidden rounded-3xl bg-ink text-paper lg:rounded-tl-[80px] lg:rounded-tr-md lg:rounded-b-md [&_img]:block [&_img]:aspect-[3/2] [&_img]:h-auto [&_img]:w-full [&_img]:object-cover">
                        <img src="{{ $heroImageUrl }}" sizes="(min-width: 1024px) 46vw, calc(100vw - 40px)" width="1536" height="1024" fetchpriority="high" decoding="async" alt="{{ $content['hero']['image_alt'] }}">
                        <figcaption><x-icon name="connect" /><span>{{ $content['hero']['image_caption'] }}</span></figcaption>
                    </figure>
                </div>
                <nav class="about-contents grid grid-cols-2 gap-2 sm:grid-cols-3 lg:grid-cols-6 [&_a]:flex [&_a]:min-h-14 [&_a]:items-center [&_a]:gap-2 [&_a]:rounded-xl [&_a]:border [&_a]:border-line [&_a]:bg-paper [&_a]:p-3 [&_a]:text-[11px]" aria-label="On this page">
                    @foreach (array_combine(['who-we-are', 'why-we-exist', 'the-problem', 'our-philosophy', 'our-approach', 'our-difference'], $content['contents']) as $id => $label)
                        <a href="#{{ $id }}"><span>0{{ $loop->iteration }}</span>{{ $label }}<span aria-hidden="true">↗</span></a>
                    @endforeach
                </nav>
            </div>
        </section>

        <section id="who-we-are" class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22 about-editorial grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-20">
            <div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['who']['label'] }}</p><h2>{{ $content['who']['title_line_one'] }}<br><em>{{ $content['who']['title_emphasis'] }}</em></h2></div>
            <div class="about-prose text-[15px] leading-[1.9] text-muted [&_p]:mb-4.5"><p class="lead text-[19px] leading-[1.7] text-ink">{{ $content['who']['lead'] }}</p>@foreach($content['who']['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach</div>
        </section>

        <section id="why-we-exist" class="about-purpose-section bg-[#f1e7ec]">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22 about-editorial grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-20">
                <div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['why']['label'] }}</p><h2>{{ $content['why']['title_line_one'] }}<br><em>{{ $content['why']['title_emphasis'] }}</em></h2><span class="about-feature-icon mt-6 grid h-18 w-15 place-items-center rounded-t-full rounded-b-md border border-[#c7aebb] text-plum"><x-icon name="faith" /></span></div>
                <div class="about-prose text-[15px] leading-[1.9] text-muted [&_p]:mb-4.5"><p class="lead text-[19px] leading-[1.7] text-ink">{{ $content['why']['lead'] }}</p><p>{{ $content['why']['paragraphs'][0] }}</p><p>{{ $content['why']['paragraphs'][1] }}</p><a href="{{ route('about.vision-mission') }}" class="underlined-link mt-2 inline-flex min-h-11 items-center gap-5 border-b border-line py-2.5 text-xs font-semibold hover:border-ink">{{ $content['why']['link_label'] }} <span aria-hidden="true">↗</span></a><p>{{ $content['why']['paragraphs'][2] }}</p></div>
            </div>
        </section>

        <section id="the-problem" class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22">
            <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['problem']['label'] }}</p><h2>{{ $content['problem']['title_line_one'] }}<br><em>{{ $content['problem']['title_emphasis'] }}</em></h2></div><p>{{ $content['problem']['introduction'] }}</p></div>
            <div class="about-card-grid grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-6">
                @foreach ($content['problem']['cards'] as $card)
                    <article class="about-info-card rounded-3xl border border-line p-6 lg:rounded-md lg:p-8 [&_h3]:mb-4 [&_h3]:text-3xl [&_p]:text-sm [&_p]:leading-[1.9] [&_p]:text-muted"><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon :name="$card['icon']" /></span><h3>{{ $card['title'] }}</h3><p>{{ $card['description'] }}</p></article>
                @endforeach
            </div>
        </section>

        <section id="our-philosophy" class="about-philosophy-section bg-ink text-paper">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22">
                <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['philosophy']['label'] }}</p><h2>{{ $content['philosophy']['title_line_one'] }}<br><em>{{ $content['philosophy']['title_emphasis'] }}</em></h2></div><p>{{ $content['philosophy']['introduction'] }}</p></div>
                <ol class="about-values grid grid-cols-1 gap-x-8 md:grid-cols-2 lg:grid-cols-3 [&_li]:flex [&_li]:items-start [&_li]:gap-4 [&_li]:border-t [&_li]:border-plum [&_li]:py-6 [&_h3]:mb-2 [&_h3]:text-3xl [&_p]:text-sm [&_p]:leading-[1.85] [&_p]:text-[#eadfe4]">@foreach($content['philosophy']['values'] as $value)<li><span class="value-index mt-2 text-[11px] text-gold">0{{ $loop->iteration }}</span><div><h3>{{ $value['name'] }}</h3><p>{{ $value['description'] }}</p></div></li>@endforeach</ol>
            </div>
        </section>

        <section id="our-approach" class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22">
            <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['approach']['label'] }}</p><h2>{{ $content['approach']['title_line_one'] }}<br><em>{{ $content['approach']['title_emphasis'] }}</em></h2></div><p>{{ $content['approach']['introduction'] }}</p></div>
            <div class="about-approach-grid grid grid-cols-1 gap-7 lg:grid-cols-2 lg:gap-16">
                <figure class="community-visual mt-6 max-w-160 overflow-hidden rounded-2xl bg-surface lg:rounded-md [&_img]:block [&_img]:aspect-[3/2] [&_img]:h-auto [&_img]:w-full [&_img]:object-cover [&_figcaption]:flex [&_figcaption]:items-center [&_figcaption]:gap-2.5 [&_figcaption]:px-4.5 [&_figcaption]:py-3.5 [&_figcaption]:text-[11px]">
                    <img src="{{ $approachImageUrl }}" sizes="(min-width: 1024px) 44vw, calc(100vw - 40px)" width="1536" height="1024" loading="lazy" decoding="async" alt="{{ $content['approach']['image_alt'] }}">
                    <figcaption><x-icon name="growth" /><span>{{ $content['approach']['image_caption'] }}</span></figcaption>
                </figure>
                <ol class="about-steps grid [&_li]:flex [&_li]:items-start [&_li]:gap-4 [&_li]:border-b [&_li]:border-line [&_li]:py-5 [&_h3]:mb-2 [&_h3]:text-3xl [&_p]:text-sm [&_p]:leading-[1.85] [&_p]:text-muted">
                    @foreach ($content['approach']['steps'] as $step)
                        <li><span class="approach-icon grid size-11 shrink-0 place-items-center rounded-xl bg-[#f1e7ec] text-plum"><x-icon :name="$step['icon']" /></span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></div></li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section id="our-difference" class="about-difference-section bg-surface">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22">
                <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['difference']['label'] }}</p><h2>{{ $content['difference']['title_line_one'] }}<br><em>{{ $content['difference']['title_emphasis'] }}</em></h2></div><p>{{ $content['difference']['introduction'] }}</p></div>
                <div class="about-card-grid grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-6 about-difference-grid md:grid-cols-2">
                    @foreach ($content['difference']['cards'] as $card)
                        <article class="about-info-card rounded-3xl border border-line p-6 lg:rounded-md lg:p-8 [&_h3]:mb-4 [&_h3]:text-3xl [&_p]:text-sm [&_p]:leading-[1.9] [&_p]:text-muted"><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon :name="$card['icon']" /></span><h3>{{ $card['title'] }}</h3><p>{{ $card['description'] }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] closing-section py-12 text-center lg:py-20 [&_h2]:my-5 [&_h2]:text-[clamp(36px,9vw,58px)] [&_h2]:lg:text-[clamp(62px,5.5vw,78px)]"><span class="closing-star mb-5 grid place-items-center text-plum"><x-icon name="growth" /></span><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('programmes.index') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d]">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
    </main>

    <x-site-footer />
    <x-mobile-navigation />
</div>
