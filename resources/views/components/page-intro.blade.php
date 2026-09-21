@props(['eyebrow', 'title', 'description', 'icon' => 'compass', 'parent' => null, 'parentUrl' => null])
<section class="inner-hero">
    <div class="shell">
        <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span>@if($parent)<a href="{{ $parentUrl }}">{{ $parent }}</a><span aria-hidden="true">/</span>@endif<span aria-current="page">{{ $eyebrow }}</span></nav>
        <div class="inner-hero-grid"><div><p class="eyebrow section-label">{{ $eyebrow }}</p><h1>{{ $title }}</h1><p class="inner-lead">{{ $description }}</p>{{ $slot }}</div><div class="inner-emblem" aria-hidden="true"><span><x-icon :name="$icon" /></span><p>FAITH · PURPOSE · CONTRIBUTION</p></div></div>
    </div>
</section>
