<x-public-page>
    <x-page-intro :eyebrow="$content['hero']['eyebrow']" :title="$content['hero']['title']" :description="$content['hero']['description']" icon="connect">
        <a href="#leadership-directory" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d]">{{ $content['hero']['action'] }} <span aria-hidden="true">↓</span></a>
    </x-page-intro>
    <nav class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] directory-jumps flex flex-wrap gap-2 py-3 [&_a]:rounded-full [&_a]:border [&_a]:border-line [&_a]:px-4 [&_a]:py-2.5 [&_a]:text-[11px]" aria-label="Leadership groups">@foreach($content['directory']['groups'] as $group)<a href="#{{ $group['id'] }}">{{ $group['title'] }}</a>@endforeach</nav>
    <div id="leadership-directory" class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] leadership-directory grid gap-14 py-10">
        @foreach($content['directory']['groups'] as $group)
            <section id="{{ $group['id'] }}" class="leadership-group grid gap-7 border-b border-line pb-14 lg:grid-cols-[.55fr_1.45fr]"><div class="group-heading self-start [&_h2]:text-4xl [&_>_div_>_p:last-child]:mt-4 [&_>_div_>_p:last-child]:text-sm [&_>_div_>_p:last-child]:leading-[1.8] [&_>_div_>_p:last-child]:text-muted"><span class="purpose-icon mb-4 grid size-12 place-items-center rounded-2xl border border-[#c7aebb] text-plum"><x-icon :name="$group['icon']" /></span><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase section-label mb-4 text-plum tracking-[1.8px]">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $content['directory']['label'] }}</p><h2>{{ $group['title'] }}</h2><p>{{ $group['description'] }}</p></div></div><div class="people-grid grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach($group['people'] as $person)
                    <article class="person-card rounded-3xl border border-line bg-surface p-6 lg:rounded-md lg:p-7 [&_.eyebrow]:text-[9px] [&_.eyebrow]:text-muted [&_h3]:my-2 [&_h3]:text-3xl [&_>_p:not(.person-role)]:text-sm [&_>_p:not(.person-role)]:leading-[1.85] [&_>_p:not(.person-role)]:text-muted">
                        @if($person['photo'] ?? null)
                            <img class="person-avatar mb-5 grid h-21 w-18 place-items-center rounded-t-full rounded-b-xl bg-[#f1e7ec] font-display text-3xl text-plum person-photo block h-36 w-30 object-cover object-top" src="{{ $this->imageUrl($person['photo']) }}" width="320" height="384" loading="lazy" decoding="async" alt="{{ $person['photo_alt'] ?: 'Portrait of '.$person['name'] }}">
                        @else
                            <div class="person-avatar mb-5 grid h-21 w-18 place-items-center rounded-t-full rounded-b-xl bg-[#f1e7ec] font-display text-3xl text-plum" aria-hidden="true">{{ $person['initials'] }}</div>
                        @endif
                        <span class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $person['profile_label'] ?? 'LEADERSHIP' }}</span><h3>{{ $person['name'] }}</h3><p class="person-role mb-3 text-xs font-semibold text-[#95682f]">{{ $person['role'] }}</p><p>{{ $person['bio'] }}</p>
                    </article>
                @endforeach
            </div></section>
        @endforeach
    </div>
    <section class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))] closing-section py-12 text-center lg:py-20 [&_h2]:my-5 [&_h2]:text-[clamp(36px,9vw,58px)] [&_h2]:lg:text-[clamp(62px,5.5vw,78px)]"><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('about.vision-mission') }}" class="button inline-flex min-h-13 items-center justify-center gap-6 rounded-xl px-5 py-3.5 text-center text-[13px] font-bold transition hover:-translate-y-0.5 lg:rounded-sm button-dark bg-ink text-white hover:bg-[#571b3d]">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
</x-public-page>
