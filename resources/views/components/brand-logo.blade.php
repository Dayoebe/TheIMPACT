@props(['compact' => false])

<span {{ $attributes->class(['brand-lockup inline-flex items-center gap-2.5', 'brand-lockup-compact' => $compact]) }}>
    <svg class="brand-mark size-12 shrink-0 overflow-visible" viewBox="0 0 82 82" role="img" aria-label="The IMPACT emblem">
        <path class="brand-mark-base-gold fill-gold" d="M7 69.5C24 60.8 57.4 60.8 75 69.5C54.2 64.2 27.3 64.2 7 69.5Z" />
        <path class="brand-mark-base fill-ink" d="M9 72.5C25.5 65.5 56.5 65.5 73 72.5C53 68.8 28.8 68.8 9 72.5Z" />
        <path class="brand-mark-person fill-ink" d="M15.3 38.8C26 42.7 31.1 51.5 33.4 64.6L24.4 65.4C22.7 54.8 19.3 46.4 15.3 38.8Z" />
        <circle class="brand-mark-person fill-ink" cx="17.8" cy="34.2" r="5.1" />
        <path class="brand-mark-person fill-ink" d="M66.8 38.8C56.1 42.7 51 51.5 48.7 64.6L57.7 65.4C59.4 54.8 62.8 46.4 66.8 38.8Z" />
        <circle class="brand-mark-person fill-ink" cx="64.3" cy="34.2" r="5.1" />
        <path class="brand-mark-growth-gold fill-gold" d="M25.8 24.3C36.1 31.7 39.6 45.8 40.6 64.4L34.3 64.4C33.3 47.8 30.8 34.8 25.8 24.3Z" />
        <path class="brand-mark-growth fill-ink" d="M56.8 24.3C46.5 31.7 43 45.8 42 64.4L48.3 64.4C49.3 47.8 51.8 34.8 56.8 24.3Z" />
        <circle class="brand-mark-person fill-ink" cx="47.2" cy="27.1" r="5.4" />
        <path class="brand-mark-cross fill-gold" d="M37 7.2H44V16.1H53.1L46 22.2H44V36.5H37V22.2H28.9L37 15.8V7.2Z" />
    </svg>
    <span class="brand-wordmark grid grid-cols-[auto_1fr] items-end gap-x-1 leading-[.88] [&_small]:col-span-2 [&_small]:mb-1 [&_small]:ml-0.5 [&_small]:text-[7px] [&_small]:font-bold [&_small]:tracking-[4.8px] [&_small]:text-[#95682f] [&_strong]:col-span-2 [&_strong]:font-display [&_strong]:text-[23px] [&_strong]:font-semibold [&_strong]:tracking-[.2px] [&_strong]:text-ink [&_>_span]:hidden"><small>THE</small><strong>IMPACT</strong><span>Christian Youth Leadership &amp; Public Impact Network</span></span>
</span>
