@props(['compact' => false])

<span {{ $attributes->class(['brand-lockup', 'brand-lockup-compact' => $compact]) }}>
    <svg class="brand-mark" viewBox="0 0 56 56" aria-hidden="true" focusable="false">
        <path class="brand-mark-field" d="M28 3.5c13.53 0 24.5 10.97 24.5 24.5S41.53 52.5 28 52.5 3.5 41.53 3.5 28 14.47 3.5 28 3.5Z" />
        <path class="brand-mark-path" d="M13 38.5c6.8-1.95 12.1-5.75 15.9-11.4 3.18-4.73 7.87-8.13 14.1-10.1" />
        <path class="brand-mark-arrow" d="m36.5 14.5 7.3 1.75-3.56 6.61" />
        <path class="brand-mark-cross" d="M27.9 12.5v25M20.5 20.5h14.8" />
    </svg>
    <span class="brand-wordmark"><small>THE</small><strong>IMPACT</strong><span>Faith. Leadership. Transformation.</span></span>
</span>
