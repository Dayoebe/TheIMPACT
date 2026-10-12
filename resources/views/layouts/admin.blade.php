<!DOCTYPE html>
@php($menuGroups = $menuGroups ?? config('menu.groups', []))
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#341027">
    <title>{{ $title ?? 'Dashboard' }} — THE IMPACT</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="admin-body min-h-screen bg-[#f4efeb] text-ink" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
    <a href="#admin-main" class="skip-link fixed -top-24 left-5 z-100 bg-gold p-4 focus:top-3">Skip to dashboard content</a>
    <div class="admin-shell min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        <div class="admin-overlay fixed inset-0 z-60 bg-ink/80 lg:hidden" x-cloak x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"></div>
        <aside class="admin-sidebar fixed inset-y-0 left-0 z-70 flex w-[min(310px,88vw)] -translate-x-full flex-col overflow-y-auto bg-ink text-white transition lg:sticky lg:top-0 lg:z-20 lg:h-screen lg:w-70 lg:translate-x-0 [&_.brand-wordmark_strong]:text-white [&_.brand-mark-base]:fill-white [&_.brand-mark-person]:fill-white [&_.brand-mark-growth]:fill-white [&.is-open]:translate-x-0" :class="{ 'is-open': sidebarOpen }" aria-label="Administration sidebar">
            <div class="admin-sidebar-brand flex min-h-24 items-center justify-between border-b border-white/10 px-5.5 py-5">
                <a href="{{ route('admin.dashboard') }}" aria-label="THE IMPACT dashboard"><x-brand-logo /></a>
                <button type="button" class="admin-sidebar-close grid size-10 place-items-center rounded-full border border-white/15 text-2xl lg:hidden" @click="sidebarOpen = false" aria-label="Close menu">×</button>
            </div>
            <div class="admin-identity mx-4 mt-4.5 mb-1.5 flex items-center gap-3 rounded-xl border border-white/10 bg-white/5 p-3.5 [&_>_span:last-child]:grid [&_strong]:text-xs [&_small]:mt-0.5 [&_small]:text-[9px] [&_small]:text-white/55">
                <span class="admin-avatar grid size-10 place-items-center rounded-full bg-gold text-[11px] font-extrabold text-ink">SA</span>
                <span><strong>{{ auth()->user()->name }}</strong><small>Super administrator</small></span>
            </div>
            <nav class="admin-menu flex-1 px-3.5 pt-2 pb-6 [&_section]:mt-6 [&_section_>_p]:px-3 [&_section_>_p]:pb-2 [&_section_>_p]:text-[8px] [&_section_>_p]:font-extrabold [&_section_>_p]:tracking-[1.6px] [&_section_>_p]:text-white/45 [&_section_>_p]:uppercase [&_a]:flex [&_a]:min-h-11 [&_a]:items-center [&_a]:gap-3 [&_a]:rounded-lg [&_a]:px-3 [&_a]:py-2.5 [&_a]:text-xs [&_a]:font-semibold [&_a]:text-white/80 [&_a]:hover:bg-white/10 [&_a]:hover:text-white [&_a.is-active]:bg-white/10 [&_a.is-active]:text-white [&_a.is-active]:shadow-[inset_3px_0_#c4985b] [&_a_small]:ml-auto [&_a_small]:text-[8px] [&_a_small]:uppercase [&_a_small]:opacity-50" aria-label="Dashboard navigation">
                @foreach($menuGroups as $group)
                    <section>
                        <p>{{ $group['label'] }}</p>
                        @foreach($group['items'] as $item)
                            <a href="{{ $item['url'] }}" @class(['is-active' => isset($item['active']) && request()->routeIs($item['active']), 'is-pending' => $item['url'] === '#']) @if($item['url'] === '#') aria-disabled="true" @click.prevent @endif @if($item['external'] ?? false) target="_blank" rel="noopener noreferrer" @endif>
                                <x-admin-icon :name="$item['icon']" />
                                <span>{{ $item['label'] }}</span>
                                @if($item['url'] === '#')<small>Soon</small>@endif
                            </a>
                        @endforeach
                    </section>
                @endforeach
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST" class="admin-logout mx-3.5 mb-5 border-t border-white/10 pt-4 [&_button]:flex [&_button]:min-h-11 [&_button]:w-full [&_button]:items-center [&_button]:gap-3 [&_button]:rounded-lg [&_button]:px-3 [&_button]:text-xs [&_button]:font-semibold [&_button]:text-white/70 [&_button]:hover:bg-white/10 [&_button]:hover:text-white">
                @csrf
                <button type="submit"><span aria-hidden="true">↪</span> Sign out</button>
            </form>
        </aside>
        <div class="admin-workspace min-w-0">
            <header class="admin-topbar sticky top-0 z-40 flex min-h-18 items-center gap-3 border-b border-line bg-paper/95 px-5 backdrop-blur lg:min-h-20 lg:px-8 [&_>_div]:grid [&_>_div]:gap-0.5 [&_small]:text-[8px] [&_small]:font-extrabold [&_small]:tracking-[1.4px] [&_small]:text-plum [&_strong]:text-xs [&_>_a]:ml-auto [&_>_a]:text-[10px] [&_>_a]:font-bold [&_>_a]:text-plum">
                <button type="button" class="admin-menu-toggle grid size-10 place-items-center rounded-lg border border-line lg:hidden" @click="sidebarOpen = true" aria-label="Open menu">☰</button>
                <div><small>THE IMPACT</small><strong>Content administration</strong></div>
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View website <span aria-hidden="true">↗</span></a>
            </header>
            <main id="admin-main" class="admin-main mx-auto w-[min(1380px,100%)] px-5 pt-7 pb-14 lg:px-8 lg:pt-8">@isset($slot){{ $slot }}@else @yield('content') @endisset</main>
        </div>
    </div>
    <div
        class="admin-toast-region pointer-events-none fixed inset-x-4 top-4 z-100 grid justify-items-end gap-3 sm:inset-x-auto sm:right-6 sm:top-6 sm:w-100"
        aria-live="polite"
        aria-atomic="true"
        x-data="{
            toasts: [],
            sequence: 0,
            show(detail) {
                const id = ++this.sequence;
                this.toasts.push({ id, message: detail.message, type: detail.type ?? 'success' });
                setTimeout(() => this.remove(id), 5000);
            },
            remove(id) {
                this.toasts = this.toasts.filter((toast) => toast.id !== id);
            }
        }"
        x-init="@if(session('status')) show({ message: @js(session('status')), type: 'success' }) @elseif(session('error')) show({ message: @js(session('error')), type: 'error' }) @endif"
        @dashboard-toast.window="show($event.detail)"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div class="admin-toast pointer-events-auto grid w-full grid-cols-[auto_1fr_auto] items-center gap-3 rounded-2xl border border-emerald-200 bg-white p-4 text-emerald-950 shadow-2xl animate__animated animate__fadeInRight" :class="toast.type === 'error' ? 'border-red-200 text-red-950' : ''" role="status">
                <span class="admin-toast-icon grid size-10 place-items-center rounded-full bg-emerald-100 text-emerald-700" :class="toast.type === 'error' ? 'bg-red-100 text-red-700' : ''" aria-hidden="true">
                    <svg x-show="toast.type === 'success'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 12 4 4L19 6" /></svg>
                    <svg x-show="toast.type !== 'success'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v5m0 3h.01" /><circle cx="12" cy="12" r="9" /></svg>
                </span>
                <span class="admin-toast-copy grid gap-0.5 text-[12px] leading-[1.5]"><strong x-text="toast.type === 'success' ? 'Done' : 'Notice'"></strong><span x-text="toast.message"></span></span>
                <button type="button" @click="remove(toast.id)" aria-label="Dismiss notification">×</button>
            </div>
        </template>
    </div>
    @livewireScripts
</body>
</html>
