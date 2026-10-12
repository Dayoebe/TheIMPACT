<div class="page pb-20 lg:pb-0" x-data="{ open: false }" @resize.window.debounce.150ms="if (window.innerWidth >= 1024) open = false">
    <x-site-header />

    <main id="main">
        <section id="home" class="hero overflow-clip bg-ink text-paper [&_.eyebrow]:flex [&_.eyebrow]:items-center [&_.eyebrow]:gap-2 [&_.eyebrow]:text-[9px] [&_.eyebrow]:tracking-[1px] [&_.eyebrow]:text-gold [&_h1]:my-5 [&_h1]:text-[clamp(44px,12vw,72px)] [&_h1]:leading-[1.02] [&_h1]:tracking-[-1.5px] [&_h1]:lg:my-7 [&_h1]:lg:text-[clamp(68px,6.5vw,94px)] [&_h1]:lg:leading-[1.09] [&_h1_em]:font-normal [&_h1_em]:text-gold">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] hero-grid grid grid-cols-1 items-center gap-7 py-8 md:py-12 lg:grid-cols-[1.15fr_1fr] lg:gap-7 lg:py-18">
                <div class="hero-copy relative z-4 min-w-0">
                    <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase"><x-icon name="faith" class="tiny-cross size-4" /> {{ $content['hero']['eyebrow'] }}</p>
                    <h1>{{ $content['hero']['title_line_one'] }}<br>{{ $content['hero']['title_line_two'] }} <em>{{ $content['hero']['title_emphasis'] }}</em></h1>
                    <p class="hero-description mb-6 max-w-120 text-[15px] leading-[1.8] text-[#eadfe4]">{{ $content['hero']['description'] }}</p>
                    <div class="hero-actions flex flex-col gap-2 min-[480px]:flex-row min-[480px]:items-center min-[480px]:gap-5"><a href="{{ route('about') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-gold bg-gold text-ink hover:bg-[#d8b47f]">{{ $content['hero']['primary_button_label'] }} <span aria-hidden="true">↗</span></a><a href="#journey" class="text-link inline-flex min-h-11 items-center justify-center gap-3 py-2.5 text-xs">{{ $content['hero']['secondary_button_label'] }} <span aria-hidden="true">→</span></a></div>
                    <div class="hero-footnote mt-5 flex items-center gap-3 text-[10px] leading-[1.7] text-[#d8cbd1] lg:mt-9"><span class="line h-px w-7 shrink-0 bg-gold"></span><span>{{ $content['hero']['footnote_line_one'] }}<br>{{ $content['hero']['footnote_line_two'] }}</span></div>
                </div>
                <figure class="hero-visual w-full max-w-160 min-w-0 justify-self-center">
                    <div class="hero-photo-frame relative overflow-hidden rounded-t-3xl bg-[#571b3d] lg:rounded-tl-[80px] lg:rounded-tr-md [&_img]:block [&_img]:aspect-[3/2] [&_img]:h-auto [&_img]:w-full [&_img]:object-cover">
                        <img src="{{ $heroImageUrl }}"
                            sizes="(min-width: 1024px) 46vw, (min-width: 768px) 640px, calc(100vw - 40px)"
                            width="1536" height="1024" fetchpriority="high" decoding="async"
                            alt="{{ $content['hero']['image_alt'] }}">
                        <span class="photo-badge absolute bottom-3 left-3 inline-flex items-center gap-2 rounded-full bg-paper px-3 py-2 text-[10px] font-semibold text-ink"><x-icon name="connect" /> {{ $content['hero']['badge'] }}</span>
                    </div>
                    <figcaption class="hero-photo-caption flex items-center gap-3 rounded-b-3xl border border-t-0 border-plum bg-[#26091c] p-4 lg:rounded-b-md lg:p-6 [&_.eyebrow]:text-[8px] [&_.eyebrow]:text-gold [&_p]:mt-1 [&_p]:font-display [&_p]:text-xl [&_p]:lg:text-3xl">
                        <span class="caption-symbol grid h-11 w-10 shrink-0 place-items-center rounded-t-full rounded-b-sm border border-plum text-gold"><x-icon name="faith" /></span>
                        <div><span class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['hero']['caption_eyebrow'] }}</span><p>{{ $content['hero']['caption_title'] }}</p></div>
                        <x-icon name="growth" class="caption-growth ml-auto size-6 text-gold" />
                    </figcaption>
                </figure>
            </div>
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] hero-bottom flex flex-wrap items-center justify-between gap-x-4 border-t border-plum py-3.5 text-[10px] text-[#eadfe4] [&_a]:inline-flex [&_a]:min-h-11 [&_a]:items-center [&_a]:gap-2 [&_a]:text-[9px] [&_a]:tracking-wide"><span>{{ $content['hero']['bottom_statement'] }}</span><a href="#about">SCROLL TO EXPLORE <span aria-hidden="true">↓</span></a></div>
        </section>

        <section class="philosophy border-b border-line bg-surface [&_.eyebrow]:text-muted [&_ol]:grid [&_ol]:grid-cols-2 [&_ol]:gap-x-5 [&_ol]:gap-y-2 [&_ol]:min-[480px]:grid-cols-3 [&_ol]:lg:flex [&_ol]:lg:flex-1 [&_ol]:lg:flex-wrap [&_ol]:lg:justify-between [&_li]:flex [&_li]:items-center [&_li]:justify-between [&_li]:gap-2 [&_li]:font-display [&_li]:text-xl [&_li]:lg:text-2xl [&_li_span]:font-sans [&_li_span]:text-xs [&_li_span]:text-plum" aria-label="Our main philosophy"><div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] philosophy-inner flex flex-col gap-3.5 py-5 lg:flex-row lg:items-center lg:gap-7"><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Our philosophy</p><ol>@foreach ($content['philosophy'] as $value)<li>{{ $value }} @unless($loop->last)<span aria-hidden="true">↗</span>@endunless</li>@endforeach</ol></div></section>

        <section id="about" class="section py-12 md:py-16 lg:py-22 shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] about-grid grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-16">
            <div class="about-intro"><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['about']['label'] }}</p><h2>{{ $content['about']['title_line_one'] }}<br><em>{{ $content['about']['title_emphasis'] }}</em></h2>
                <figure class="community-visual mt-6 max-w-160 overflow-hidden rounded-2xl bg-surface lg:rounded-md [&_img]:block [&_img]:aspect-[3/2] [&_img]:h-auto [&_img]:w-full [&_img]:object-cover [&_figcaption]:flex [&_figcaption]:items-center [&_figcaption]:gap-2.5 [&_figcaption]:px-4.5 [&_figcaption]:py-3.5 [&_figcaption]:text-[11px]">
                    <img src="{{ $aboutImageUrl }}"
                        sizes="(min-width: 1024px) 44vw, (min-width: 768px) 640px, calc(100vw - 40px)"
                        width="1536" height="1024" loading="lazy" decoding="async"
                        alt="{{ $content['about']['image_alt'] }}">
                    <figcaption><x-icon name="growth" /><span>{{ $content['about']['image_caption'] }}</span></figcaption>
                </figure>
            </div>
            <div class="about-copy self-center lg:pt-9 [&_p]:mb-4 [&_p]:text-[15px] [&_p]:leading-[1.85] [&_p]:text-muted"><p class="lead text-[19px] leading-[1.7] text-ink">{{ $content['about']['lead'] }}</p>@foreach($content['about']['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach<a href="{{ route('about') }}" class="underlined-link mt-2 inline-flex min-h-11 items-center gap-5 border-b border-line py-2.5 text-xs font-semibold hover:border-ink">{{ $content['about']['link_label'] }} <span aria-hidden="true">↗</span></a></div>
        </section>

        <section class="founder-section overflow-hidden bg-ink py-14 text-white lg:py-22" aria-labelledby="founder-heading">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] founder-grid grid grid-cols-1 items-center gap-8 lg:grid-cols-[.82fr_1.18fr] lg:gap-20">
                <figure class="founder-portrait relative w-[min(100%,520px)] justify-self-center overflow-hidden rounded-tl-[90px] rounded-tr-lg rounded-b-lg bg-[#571b3d] lg:justify-self-start [&_img]:block [&_img]:aspect-[3/3.35] [&_img]:w-full [&_img]:object-cover [&_img]:object-[center_22%] [&_figcaption]:absolute [&_figcaption]:inset-x-0 [&_figcaption]:bottom-0 [&_figcaption]:grid [&_figcaption]:gap-1 [&_figcaption]:bg-gradient-to-t [&_figcaption]:from-[#26091c] [&_figcaption]:to-transparent [&_figcaption]:px-6 [&_figcaption]:pt-10 [&_figcaption]:pb-6 [&_figcaption_span]:font-display [&_figcaption_span]:text-3xl [&_figcaption_strong]:text-[9px] [&_figcaption_strong]:font-bold [&_figcaption_strong]:tracking-[1.4px] [&_figcaption_strong]:text-gold [&_figcaption_strong]:uppercase">
                    <img src="{{ $founderImageUrl }}" width="960" height="1280" loading="lazy" decoding="async" alt="{{ $content['founder']['image_alt'] }}">
                    <figcaption><span>{{ $content['founder']['name'] }}</span><strong>{{ $content['founder']['role'] }}</strong></figcaption>
                </figure>
                <div class="founder-copy max-w-155 [&_h2_em]:font-normal [&_h2_em]:text-gold [&_.eyebrow]:text-gold [&_h2]:my-5 [&_h2]:text-[clamp(40px,10vw,62px)] [&_>_p:not(.eyebrow)]:text-[15px] [&_>_p:not(.eyebrow)]:leading-[1.9] [&_>_p:not(.eyebrow)]:text-[#eadfe4]">
                    <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['founder']['eyebrow'] }}</p>
                    <h2 id="founder-heading">{{ $content['founder']['title_line_one'] }}<br><em>{{ $content['founder']['title_emphasis'] }}</em></h2>
                    <p>{{ $content['founder']['description'] }}</p>
                    <a href="{{ route('leadership') }}" class="underlined-link mt-2 inline-flex min-h-11 items-center gap-5 border-b border-line py-2.5 text-xs font-semibold hover:border-ink">{{ $content['founder']['link_label'] }} <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section id="vision" class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] vision-grid grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-5 [&_h2]:mt-6 [&_h2]:text-4xl [&_h2]:lg:text-5xl [&_article_>_p:not(.eyebrow)]:my-5 [&_article_>_p:not(.eyebrow)]:text-[15px] [&_article_>_p:not(.eyebrow)]:leading-[1.85]">
            <article class="vision-card relative flex flex-col overflow-hidden rounded-3xl border border-line border-t-3 border-t-plum bg-[#f1e7ec] p-6 lg:rounded-md lg:p-10"><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon name="compass" /></span><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['vision']['eyebrow'] }}</p><span class="card-number absolute top-3.5 right-4 font-display text-5xl text-ink/15" aria-hidden="true">01</span><h2>{{ $content['vision']['title'] }}<span>.</span></h2><p>{{ $content['vision']['statement'] }}</p><div class="card-caption mt-auto flex items-center gap-3 border-t border-ink/15 pt-4 text-[11px] leading-[1.7]"><span aria-hidden="true">↗</span> {{ $content['vision']['caption'] }}</div></article>
            <article class="mission-card relative flex flex-col overflow-hidden rounded-3xl border border-line border-t-3 border-t-gold bg-[#f3e8d7] p-6 lg:rounded-md lg:p-10"><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon name="deploy" /></span><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['mission']['eyebrow'] }}</p><span class="card-number absolute top-3.5 right-4 font-display text-5xl text-ink/15" aria-hidden="true">02</span><h2>{{ $content['mission']['title'] }}<span>.</span></h2><p>{{ $content['mission']['statement'] }}</p><div class="card-caption mt-auto flex items-center gap-3 border-t border-ink/15 pt-4 text-[11px] leading-[1.7]"><span aria-hidden="true">↗</span> {{ $content['mission']['caption'] }}</div></article>
        </section>

        <section id="focus" class="section py-12 md:py-16 lg:py-22 shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))]" x-data="{ active: 0 }">
            <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['focus']['label'] }}</p><h2>{{ $content['focus']['title_line_one'] }}<br><em>{{ $content['focus']['title_emphasis'] }}</em></h2></div><p>{{ $content['focus']['introduction'] }}</p></div>
            <div class="focus-grid grid grid-cols-1 gap-6 md:grid-cols-[1fr_1.2fr] lg:grid-cols-2 lg:gap-12">
                <div class="focus-tabs overflow-hidden rounded-2xl border border-line lg:rounded-md [&_button]:flex [&_button]:min-h-14 [&_button]:w-full [&_button]:items-center [&_button]:gap-3 [&_button]:border-b [&_button]:border-line [&_button]:px-4 [&_button]:py-3.5 [&_button]:text-left [&_button]:text-sm [&_button]:last:border-b-0 [&_button]:lg:min-h-18 [&_button]:lg:text-base [&_button.is-active]:bg-ink [&_button.is-active]:text-white [&_button.is-active]:shadow-[inset_3px_0_#c4985b]" role="tablist" aria-label="Our focus areas" aria-orientation="vertical">
                    @foreach ($content['focus']['areas'] as $area)
                        <button id="focus-tab-{{ $loop->index }}" type="button" role="tab" aria-controls="focus-panel-{{ $loop->index }}" :aria-selected="active === {{ $loop->index }}" :tabindex="active === {{ $loop->index }} ? 0 : -1" :class="{ 'is-active': active === {{ $loop->index }} }" @click="active = {{ $loop->index }}" @keydown.arrow-down.prevent="active = (active + 1) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.arrow-up.prevent="active = (active + 4) % 5; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.home.prevent="active = 0; $nextTick(() => $el.parentElement.children[active].focus())" @keydown.end.prevent="active = 4; $nextTick(() => $el.parentElement.children[active].focus())"><x-icon :name="$area['icon']" class="tab-icon size-5.5" />{{ $area['name'] }}<span class="tab-arrow ml-auto text-xl" aria-hidden="true">↗</span></button>
                    @endforeach
                </div>
                <div class="focus-content rounded-2xl border border-line bg-surface p-6 lg:rounded-md lg:p-9 [&_h3]:my-3.5 [&_h3]:text-4xl [&_article_>_p:not(.eyebrow)]:text-[15px] [&_article_>_p:not(.eyebrow)]:leading-[1.85] [&_article_>_p:not(.eyebrow)]:text-muted">
                    @foreach ($content['focus']['areas'] as $area)
                        <article id="focus-panel-{{ $loop->index }}" role="tabpanel" aria-labelledby="focus-tab-{{ $loop->index }}" tabindex="0" x-show="active === {{ $loop->index }}" @if(!$loop->first) x-cloak @endif>
                            <div class="focus-icon mb-5 grid size-14 place-items-center rounded-2xl bg-[#f1e7ec] text-plum"><x-icon :name="$area['icon']" /></div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $area['eyebrow'] }}</p><h3>{{ $area['title'] }}</h3><p>{{ $area['description'] }}</p><a href="{{ route('programmes.index') }}" class="underlined-link mt-2 inline-flex min-h-11 items-center gap-5 border-b border-line py-2.5 text-xs font-semibold hover:border-ink">{{ $content['focus']['link_label'] }} <span aria-hidden="true">→</span></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="journey" class="journey-section bg-ink text-paper [&_h2_em]:font-normal [&_h2_em]:text-gold"><div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22">
            <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['journey']['label'] }}</p><h2>{{ $content['journey']['title_line_one'] }}<br>{{ $content['journey']['title_line_two'] }} <em>{{ $content['journey']['title_emphasis'] }}</em></h2></div><p>{{ $content['journey']['introduction'] }}</p></div>
            <ol class="journey-grid mt-7 grid grid-cols-1 gap-3 md:grid-cols-2 lg:mt-12 lg:grid-cols-5 lg:gap-0 [&_li]:rounded-2xl [&_li]:border [&_li]:border-plum [&_li]:bg-white/5 [&_li]:p-5 [&_li]:lg:rounded-none [&_li]:lg:border-0 [&_li]:lg:border-t [&_li]:lg:p-5 [&_h3]:my-2 [&_h3]:font-display [&_h3]:text-3xl [&_h3]:lg:mt-6 [&_p]:text-sm [&_p]:leading-[1.8] [&_p]:text-[#eadfe4]">
                @foreach ($content['journey']['steps'] as $step)
                    <li><div class="step-top flex items-center justify-between text-[11px] text-gold"><span>0{{ $loop->iteration }}</span><x-icon :name="$step['icon']" /></div><h3>{{ $step['name'] }}</h3><p class="step-label mb-3 text-xs text-gold">{{ $step['label'] }}</p><p>{{ $step['description'] }}</p></li>
                @endforeach
            </ol>
        </div></section>

        <section id="programmes" class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22 homepage-programmes overflow-hidden">
            <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['programmes']['label'] }}</p><h2>{{ $content['programmes']['title_line_one'] }}<br><em>{{ $content['programmes']['title_emphasis'] }}</em></h2></div><p>{{ $content['programmes']['introduction'] }}</p></div>
            <div class="homepage-programme-grid grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
                @foreach($programmes as $programme)
                    <article class="homepage-programme-card flex min-h-80 flex-col rounded-2xl border border-line bg-paper p-5 transition hover:-translate-y-1 hover:border-plum hover:shadow-xl lg:rounded-md lg:p-7 [&_>_div]:flex [&_>_div]:items-start [&_>_div]:justify-between [&_>_div]:gap-4 [&_.purpose-icon]:mb-0 [&_h3]:mt-8 [&_h3]:mb-3 [&_h3]:text-3xl [&_>_p]:text-sm [&_>_p]:leading-[1.8] [&_>_p]:text-muted [&_.underlined-link]:mt-auto [&_.underlined-link]:self-start [&_.underlined-link]:pt-6">
                        <div><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon :name="$programme->icon" /></span><span class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $programme->category }}</span></div>
                        <h3><a href="{{ route('programmes.show', $programme->slug) }}">{{ $programme->name }}</a></h3>
                        <p>{{ $programme->summary }}</p>
                        <a href="{{ route('programmes.show', $programme->slug) }}" class="underlined-link mt-2 inline-flex min-h-11 items-center gap-5 border-b border-line py-2.5 text-xs font-semibold hover:border-ink" aria-label="Explore {{ $programme->name }}">Explore pathway <span aria-hidden="true">↗</span></a>
                    </article>
                @endforeach
            </div>
            <div class="homepage-section-action mt-7 flex justify-center lg:mt-10"><a href="{{ route('programmes.index') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d]">{{ $content['programmes']['button_label'] }} <span aria-hidden="true">↗</span></a></div>
        </section>

        <section class="homepage-mentorship overflow-hidden bg-plum py-14 text-white lg:py-22 [&_.eyebrow]:text-gold [&_h2]:my-5 [&_h2]:text-[clamp(42px,8vw,72px)] [&_h2_em]:font-normal [&_h2_em]:text-gold [&_.lead]:mb-4 [&_.lead]:text-white [&_p:not(.eyebrow):not(.lead)]:mb-7 [&_p:not(.eyebrow):not(.lead)]:max-w-175 [&_p:not(.eyebrow):not(.lead)]:text-[15px] [&_p:not(.eyebrow):not(.lead)]:leading-[1.9] [&_p:not(.eyebrow):not(.lead)]:text-[#eadfe4]">
            <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] homepage-mentorship-grid grid items-center gap-9 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
                <div class="homepage-mentorship-mark relative grid min-h-75 place-content-center justify-items-center rounded-t-[100px] border border-white/20 bg-white/5 text-gold [&_>_svg]:mb-8 [&_>_svg]:size-20 [&_span]:font-display [&_span]:text-[clamp(44px,7vw,82px)] [&_span]:leading-[.85]" aria-hidden="true"><x-icon name="mentor" /><span>Experience</span><span>Potential</span></div>
                <div>
                    <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['mentorship']['eyebrow'] }}</p>
                    <h2>{{ $content['mentorship']['title_line_one'] }}<br><em>{{ $content['mentorship']['title_emphasis'] }}</em></h2>
                    <p class="lead text-[19px] leading-[1.7] text-ink">{{ $content['mentorship']['lead'] }}</p>
                    <p>{{ $content['mentorship']['description'] }}</p>
                    <a href="{{ route('mentorship') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-gold bg-gold text-ink hover:bg-[#d8b47f]">{{ $content['mentorship']['button_label'] }} <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] section py-12 md:py-16 lg:py-22 homepage-participate border-b border-line">
            <div class="section-heading mb-6 flex flex-col gap-5 lg:mb-10 lg:flex-row lg:items-end lg:justify-between lg:gap-12 [&_>_p]:max-w-130 [&_>_p]:text-[15px] [&_>_p]:leading-[1.85] [&_>_p]:text-muted [&_>_p]:lg:max-w-80"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ $content['participate']['label'] }}</p><h2>{{ $content['participate']['title_line_one'] }}<br><em>{{ $content['participate']['title_emphasis'] }}</em></h2></div><p>{{ $content['participate']['introduction'] }}</p></div>
            <div class="homepage-pathway-grid grid grid-cols-1 gap-3 md:grid-cols-3">
                @foreach($content['participate']['pathways'] as $pathway)
                    @php($pathwayRoute = ['programmes.index', 'mentorship', 'about.vision-mission'][$loop->index])
                    <article class="homepage-pathway-card relative flex min-h-75 flex-col rounded-2xl border border-line bg-surface p-6 lg:rounded-md lg:p-8 [&_h3]:mt-5 [&_h3]:mb-3 [&_h3]:text-3xl [&_>_p]:text-sm [&_>_p]:leading-[1.8] [&_>_p]:text-muted [&_.underlined-link]:mt-auto [&_.underlined-link]:self-start [&_.underlined-link]:pt-6"><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon :name="$pathway['icon']" /></span><span class="card-number absolute top-3.5 right-4 font-display text-5xl text-ink/15" aria-hidden="true">0{{ $loop->iteration }}</span><h3>{{ $pathway['title'] }}</h3><p>{{ $pathway['description'] }}</p><a href="{{ route($pathwayRoute) }}" class="underlined-link mt-2 inline-flex min-h-11 items-center gap-5 border-b border-line py-2.5 text-xs font-semibold hover:border-ink">{{ $pathway['button_label'] }} <span aria-hidden="true">↗</span></a></article>
                @endforeach
            </div>
        </section>

        <section class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] closing-section py-12 text-center lg:py-20 [&_h2]:my-5 [&_h2]:text-[clamp(36px,9vw,58px)] [&_h2]:lg:text-[clamp(62px,5.5vw,78px)]"><span class="closing-star mb-5 grid place-items-center text-plum"><x-icon name="growth" /></span><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br>{{ $content['closing']['title_line_two'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('about.vision-mission') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d]">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
    </main>
    <x-site-footer />
    <x-mobile-navigation />
</div>
