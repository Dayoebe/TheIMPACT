@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
    <section class="admin-welcome relative flex flex-col items-start gap-6 overflow-hidden rounded-3xl bg-ink p-7 text-white lg:flex-row lg:items-end lg:justify-between lg:rounded-lg lg:p-9 [&_h1]:my-2.5 [&_h1]:text-[clamp(38px,8vw,60px)] [&_p:not(.eyebrow)]:max-w-175 [&_p:not(.eyebrow)]:text-[13px] [&_p:not(.eyebrow)]:leading-[1.8] [&_p:not(.eyebrow)]:text-[#eadfe4] [&_.eyebrow]:text-gold">
        <div>
            <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Administration overview</p>
            <h1>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ str(auth()->user()->name)->before(' ') }}.</h1>
            <p>Your central workspace for managing THE IMPACT’s public presence. Content modules are mapped in the sidebar and will become active as each management area is built.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="admin-primary-action inline-flex min-h-12 items-center gap-5 rounded-lg bg-gold px-4.5 py-3 text-[11px] font-extrabold text-ink">Open public website <span aria-hidden="true">↗</span></a>
    </section>

    <section class="admin-stat-grid my-4.5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4 [&_article]:grid [&_article]:grid-cols-[auto_1fr_auto] [&_article]:items-center [&_article]:gap-3.5 [&_article]:rounded-xl [&_article]:border [&_article]:border-line [&_article]:bg-paper [&_article]:p-4.5 [&_strong]:font-display [&_strong]:text-3xl [&_p]:text-[10px] [&_p]:text-muted" aria-label="Website content summary">
        <article><span class="admin-stat-icon grid size-10 place-items-center rounded-xl bg-[#f1e7ec] text-plum"><x-admin-icon name="programmes" /></span><div><strong>{{ str_pad((string) $programmeCount, 2, '0', STR_PAD_LEFT) }}</strong><p>Programme pathways</p></div><small>Configured</small></article>
        <article><span class="admin-stat-icon grid size-10 place-items-center rounded-xl bg-[#f1e7ec] text-plum"><x-admin-icon name="leadership" /></span><div><strong>{{ str_pad((string) $leadershipGroupCount, 2, '0', STR_PAD_LEFT) }}</strong><p>Leadership groups</p></div><small>Configured</small></article>
        <article><span class="admin-stat-icon grid size-10 place-items-center rounded-xl bg-[#f1e7ec] text-plum"><x-admin-icon name="philosophy" /></span><div><strong>{{ str_pad((string) $missionStepCount, 2, '0', STR_PAD_LEFT) }}</strong><p>Mission steps</p></div><small>Configured</small></article>
        <article><span class="admin-stat-icon grid size-10 place-items-center rounded-xl bg-[#f1e7ec] text-plum"><x-admin-icon name="vision" /></span><div><strong>07</strong><p>Public pages</p></div><small>Live</small></article>
    </section>

    <div class="admin-dashboard-grid grid grid-cols-1 gap-4.5 lg:grid-cols-[1.65fr_.75fr]">
        <section class="admin-panel rounded-2xl border border-line bg-paper p-5 lg:rounded-lg lg:p-7 admin-control-map grid">
            <div class="admin-panel-heading flex items-start justify-between gap-4 border-b border-line pb-5 [&_h2]:mt-2 [&_h2]:text-3xl"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Control map</p><h2>Everything in one place.</h2></div><span>Foundation stage</span></div>
            <div class="admin-control-list grid [&_article]:grid [&_article]:grid-cols-[28px_36px_1fr] [&_article]:gap-2.5 [&_article]:border-b [&_article]:border-line [&_article]:py-5 [&_h3]:text-xl [&_p]:mt-1.5 [&_p]:text-[11px] [&_p]:leading-[1.7] [&_p]:text-muted">
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

        <aside class="admin-panel rounded-2xl border border-line bg-paper p-5 lg:rounded-lg lg:p-7 admin-status-panel grid [&_ul]:grid [&_ul]:gap-4 [&_ul]:py-5 [&_li]:flex [&_li]:items-center [&_li]:gap-3">
            <div class="admin-panel-heading flex items-start justify-between gap-4 border-b border-line pb-5 [&_h2]:mt-2 [&_h2]:text-3xl"><div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">System status</p><h2>Ready to build.</h2></div></div>
            <ul>
                <li><span class="is-ready bg-emerald-600!"></span><div><strong>Secure access</strong><small>Super-admin protection active</small></div></li>
                <li><span class="is-ready bg-emerald-600!"></span><div><strong>Public website</strong><small>Live and connected</small></div></li>
                <li><span class="is-ready bg-emerald-600!"></span><div><strong>Content architecture</strong><small>Menu map configured</small></div></li>
                <li><span class="is-planned bg-[#f3e8d7] text-[#95682f]"></span><div><strong>Management modules</strong><small>Awaiting implementation</small></div></li>
            </ul>
            <div class="admin-next-step rounded-xl bg-[#f1e7ec] p-4.5 [&_strong]:my-2 [&_strong]:block [&_strong]:font-display [&_strong]:text-2xl"><span>Next recommended module</span><strong>Website content management</strong><p>Move the current public-page content from configuration files into editable, validated records.</p></div>
        </aside>
    </div>
@endsection
