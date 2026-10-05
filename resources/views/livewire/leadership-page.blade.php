<x-public-page>
    <x-page-intro :eyebrow="$content['hero']['eyebrow']" :title="$content['hero']['title']" :description="$content['hero']['description']" icon="connect">
        <a href="#leadership-directory" class="button button-dark">{{ $content['hero']['action'] }} <span aria-hidden="true">↓</span></a>
    </x-page-intro>
    <div class="shell preview-notice"><x-icon name="identify" /><p><strong>{{ $content['notice']['title'] }}</strong> {{ $content['notice']['text'] }}</p></div>
    <nav class="shell directory-jumps" aria-label="Leadership groups">@foreach($content['directory']['groups'] as $group)<a href="#{{ $group['id'] }}">{{ $group['title'] }}</a>@endforeach</nav>
    <div id="leadership-directory" class="shell leadership-directory">
        @foreach($content['directory']['groups'] as $group)
            <section id="{{ $group['id'] }}" class="leadership-group"><div class="group-heading"><span class="purpose-icon"><x-icon :name="$group['icon']" /></span><div><p class="eyebrow section-label">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $content['directory']['label'] }}</p><h2>{{ $group['title'] }}</h2><p>{{ $group['description'] }}</p></div></div><div class="people-grid">
                @forelse($group['people'] as $person)
                    <article class="person-card"><div class="person-avatar" aria-hidden="true">{{ $person['initials'] }}</div><span class="eyebrow">{{ $person['profile_label'] ?? $content['directory']['sample_label'] }}</span><h3>{{ $person['name'] }}</h3><p class="person-role">{{ $person['role'] }}</p><p>{{ $person['bio'] }}</p></article>
                @empty
                    <div class="empty-state"><p class="eyebrow">{{ $content['directory']['empty_label'] }}</p><p>{{ $content['directory']['empty_text'] }}</p></div>
                @endforelse
            </div></section>
        @endforeach
    </div>
    <section class="shell closing-section"><p class="eyebrow">{{ $content['closing']['eyebrow'] }}</p><h2>{{ $content['closing']['title_line_one'] }}<br><em>{{ $content['closing']['title_emphasis'] }}</em></h2><a href="{{ route('about.vision-mission') }}" class="button button-dark">{{ $content['closing']['button_label'] }} <span aria-hidden="true">↗</span></a></section>
</x-public-page>
