@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
    <section class="admin-welcome">
        <div>
            <p class="eyebrow">Administration overview</p>
            <h1>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ str(auth()->user()->name)->before(' ') }}.</h1>
            <p>Your central workspace for managing THE IMPACT’s public presence. Content modules are mapped in the sidebar and will become active as each management area is built.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="admin-primary-action">Open public website <span aria-hidden="true">↗</span></a>
    </section>

    <section class="admin-stat-grid" aria-label="Website content summary">
        <article><span class="admin-stat-icon"><x-admin-icon name="programmes" /></span><div><strong>{{ str_pad((string) $programmeCount, 2, '0', STR_PAD_LEFT) }}</strong><p>Programme pathways</p></div><small>Configured</small></article>
        <article><span class="admin-stat-icon"><x-admin-icon name="leadership" /></span><div><strong>{{ str_pad((string) $leadershipGroupCount, 2, '0', STR_PAD_LEFT) }}</strong><p>Leadership groups</p></div><small>Configured</small></article>
        <article><span class="admin-stat-icon"><x-admin-icon name="philosophy" /></span><div><strong>{{ str_pad((string) $missionStepCount, 2, '0', STR_PAD_LEFT) }}</strong><p>Mission steps</p></div><small>Configured</small></article>
        <article><span class="admin-stat-icon"><x-admin-icon name="vision" /></span><div><strong>07</strong><p>Public pages</p></div><small>Live</small></article>
    </section>

    <div class="admin-dashboard-grid">
        <section class="admin-panel admin-control-map">
            <div class="admin-panel-heading"><div><p class="eyebrow">Control map</p><h2>Everything in one place.</h2></div><span>Foundation stage</span></div>
            <div class="admin-control-list">
                @foreach([
                    ['01', 'Website content', 'Homepage, organisation story, vision, mission, philosophy and focus areas.', 'about'],
                    ['02', 'Programmes & mentorship', 'Programme pathways, cohorts, curriculum, facilitators and participation.', 'programmes'],
                    ['03', 'People & engagement', 'Leadership profiles, applications, enquiries and relationship records.', 'users'],
                    ['04', 'Brand & discovery', 'Media assets, website settings, SEO metadata and social sharing.', 'seo'],
                ] as [$number, $name, $description, $icon])
                    <article><span>{{ $number }}</span><x-admin-icon :name="$icon" /><div><h3>{{ $name }}</h3><p>{{ $description }}</p></div><small>Planned</small></article>
                @endforeach
            </div>
        </section>

        <aside class="admin-panel admin-status-panel">
            <div class="admin-panel-heading"><div><p class="eyebrow">System status</p><h2>Ready to build.</h2></div></div>
            <ul>
                <li><span class="is-ready"></span><div><strong>Secure access</strong><small>Super-admin protection active</small></div></li>
                <li><span class="is-ready"></span><div><strong>Public website</strong><small>Live and connected</small></div></li>
                <li><span class="is-ready"></span><div><strong>Content architecture</strong><small>Menu map configured</small></div></li>
                <li><span class="is-planned"></span><div><strong>Management modules</strong><small>Awaiting implementation</small></div></li>
            </ul>
            <div class="admin-next-step"><span>Next recommended module</span><strong>Website content management</strong><p>Move the current public-page content from configuration files into editable, validated records.</p></div>
        </aside>
    </div>
@endsection
