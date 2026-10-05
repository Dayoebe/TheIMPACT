<x-public-page>
    <x-page-intro :eyebrow="$content['hero']['eyebrow']" :title="$content['hero']['title']" :description="$content['hero']['description']" icon="equip">
        <a href="#programme-directory" class="button button-dark">{{ $content['hero']['button_label'] }} <span aria-hidden="true">↓</span></a>
    </x-page-intro>
    <section class="shell section" id="programme-directory"><div class="section-heading"><div><p class="eyebrow section-label">{{ $content['directory']['label'] }}</p><h2>{{ $content['directory']['title_line_one'] }}<br><em>{{ $content['directory']['title_emphasis'] }}</em></h2></div><p>{{ $content['directory']['introduction'] }}</p></div><div class="programme-grid">
        @forelse($programmes as $programme)
            <article class="programme-card"><div class="programme-card-top"><span class="purpose-icon"><x-icon :name="$programme->icon" /></span><span class="eyebrow">0{{ $loop->iteration }} / {{ $programme->category }}</span></div><h3><a href="{{ route('programmes.show', $programme->slug) }}">{{ $programme->name }}</a></h3><p>{{ $programme->summary }}</p><div class="programme-card-bottom">@if($programme->duration)<span>{{ $programme->duration }}</span>@endif<a href="{{ route('programmes.show', $programme->slug) }}" class="underlined-link" aria-label="Explore {{ $programme->name }}">{{ $content['directory']['card_action'] }} <span aria-hidden="true">↗</span></a></div></article>
        @empty
            <div class="empty-state"><p>No programmes are published yet. Please check back soon.</p></div>
        @endforelse
    </div></section>
    <section class="about-purpose-section"><div class="shell section statement-grid"><div><p class="eyebrow section-label">{{ $content['mentorship']['label'] }}</p><h2>{{ $content['mentorship']['title_line_one'] }}<br><em>{{ $content['mentorship']['title_emphasis'] }}</em></h2></div><div class="about-prose"><p class="lead">{{ $content['mentorship']['lead'] }}</p><p>{{ $content['mentorship']['description'] }}</p><a href="{{ route('mentorship') }}" class="button button-dark">{{ $content['mentorship']['button_label'] }} <span aria-hidden="true">↗</span></a></div></div></section>
</x-public-page>
