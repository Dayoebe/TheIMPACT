<x-public-page>
    <x-page-intro :eyebrow="$content['hero']['eyebrow']" :title="$content['hero']['title']" :description="$content['hero']['description']" icon="connect">
        <a href="#leadership-directory" class="button button-dark">{{ $content['hero']['action'] }} <span aria-hidden="true">↓</span></a>
    </x-page-intro>
    <nav class="shell directory-jumps" aria-label="Leadership groups">@foreach($content['directory']['groups'] as $group)<a href="#{{ $group['id'] }}">{{ $group['title'] }}</a>@endforeach</nav>
    <div id="leadership-directory" class="shell leadership-directory">
        @foreach($content['directory']['groups'] as $group)
            <section id="{{ $group['id'] }}" class="leadership-group"><div class="group-heading"><span class="purpose-icon"><x-icon :name="$group['icon']" /></span><div><p class="eyebrow section-label">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $content['directory']['label'] }}</p><h2>{{ $group['title'] }}</h2><p>{{ $group['description'] }}</p></div></div><div class="people-grid">
                @foreach($group['people'] as $person)
                    <article class="person-card">
                        @if($person['photo'] ?? null)
                            <img class="person-avatar person-photo" src="{{ $this->imageUrl($person['photo']) }}" width="320" height="384" loading="lazy" decoding="async" alt="{{ $person['photo_alt'] ?: 'Portrait of '.$person['name'] }}">
                        @else
                            <div class="person-avatar" aria-hidden="true">{{ $person['initials'] }}</div>
                        @endif
                        <span class="eyebrow">{{ $person['profile_label'] ?? 'LEADERSHIP' }}</span><h3>{{ $person['name'] }}</h3><p class="person-role">{{ $person['role'] }}</p><p>{{ $person['bio'] }}</p>
                    </article>
                @endforeach
            </div></section>
        @endforeach
    </div>
    <section class="shell closing-section"><p class="eyebrow">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('about.vision-mission') }}" class="button button-dark">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
</x-public-page>
