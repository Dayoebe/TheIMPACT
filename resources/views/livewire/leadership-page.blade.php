<x-public-page>
    <x-page-intro eyebrow="Leadership" title="People entrusted with purpose." description="Leadership is a responsibility to serve. Meet the roles that guide the vision, steward the mission and support the work of THE IMPACT." icon="connect">
        <a href="#leadership-directory" class="button button-dark">Explore our leadership <span aria-hidden="true">↓</span></a>
    </x-page-intro>
    <div class="shell preview-notice"><x-icon name="identify" /><p><strong>Illustrative leadership directory.</strong> Names, roles and biographies below are sample content, not confirmed appointments.</p></div>
    <nav class="shell directory-jumps" aria-label="Leadership groups">@foreach(config('impact.leadership') as $id => $group)<a href="#{{ $id }}">{{ $group['title'] }}</a>@endforeach</nav>
    <div id="leadership-directory" class="shell leadership-directory">
        @foreach(config('impact.leadership') as $id => $group)
            <section id="{{ $id }}" class="leadership-group"><div class="group-heading"><span class="purpose-icon"><x-icon :name="$group['icon']" /></span><div><p class="eyebrow section-label">0{{ $loop->iteration }} / LEADERSHIP</p><h2>{{ $group['title'] }}</h2><p>{{ $group['description'] }}</p></div></div><div class="people-grid">
                @forelse($group['people'] as $person)
                    <article class="person-card"><div class="person-avatar" aria-hidden="true">{{ $person['initials'] }}</div><span class="eyebrow">SAMPLE PROFILE</span><h3>{{ $person['name'] }}</h3><p class="person-role">{{ $person['role'] }}</p><p>{{ $person['bio'] }}</p></article>
                @empty
                    <div class="empty-state"><p class="eyebrow">PROFILES TO FOLLOW</p><p>Leadership profiles for this group will be published once confirmed.</p></div>
                @endforelse
            </div></section>
        @endforeach
    </div>
    <section class="shell closing-section"><p class="eyebrow">ONE NETWORK. ONE SHARED PURPOSE.</p><h2>Meet the mission<br><em>behind the people.</em></h2><a href="{{ route('about.vision-mission') }}" class="button button-dark">Vision & Mission <span aria-hidden="true">↗</span></a></section>
</x-public-page>
