<footer class="site-footer border-t border-line bg-surface [&_.brand-wordmark_>_span]:mt-2 [&_.brand-wordmark_>_span]:block [&_.brand-wordmark_>_span]:text-[7px] [&_.brand-wordmark_>_span]:font-bold [&_.brand-wordmark_>_span]:tracking-[1px] [&_.brand-wordmark_>_span]:text-muted [&_.brand-wordmark_>_span]:uppercase [&_.brand-wordmark_>_span]:lg:col-span-2">
    <div class="shell mx-auto w-[min(1240px,calc(100%-40px))] md:w-[min(1240px,calc(100%-64px))]">
        <div class="footer-main flex flex-col items-start gap-5 py-7 md:flex-row md:flex-wrap md:items-center md:justify-between lg:py-10 [&_>_p]:text-xs [&_>_p]:leading-[1.8] [&_>_p]:text-muted [&_nav]:flex [&_nav]:flex-wrap [&_nav]:gap-x-6 [&_nav]:gap-y-2 [&_nav]:text-xs [&_nav_a]:inline-flex [&_nav_a]:min-h-11 [&_nav_a]:items-center"><a href="{{ route('home') }}" class="brand inline-flex min-h-12 shrink-0 items-center" aria-label="The IMPACT home"><x-brand-logo /></a>
            <p>Christian Youth Leadership<br>& Public Impact Network</p>
            <nav aria-label="Footer navigation">
                @foreach(['about' => 'About', 'about.vision-mission' => 'Vision & Mission', 'leadership' => 'Leadership', 'programmes.index' => 'Programmes', 'mentorship' => 'Mentorship'] as $routeName => $label)<a
                href="{{ route($routeName) }}">{{ $label }}</a>@endforeach</nav>
        </div>
                <div class="footer-bottom flex flex-wrap items-center justify-between gap-x-5 gap-y-2 border-t border-line py-4 text-[11px] leading-[1.8] text-muted [&_a]:inline-flex [&_a]:min-h-11 [&_a]:items-center"><span>© {{ date('Y') }} <a href="https://dayoebe.github.io" target="_blank" rel="noopener noreferrer">Wireless Terminal</a>. All rights reserved.</span><span>Faith →
                Leadership → Transformation</span><a href="#main">Back to top ↑</a></div>
    </div>
</footer>
