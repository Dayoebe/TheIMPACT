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
<body class="admin-body" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
    <a href="#admin-main" class="skip-link">Skip to dashboard content</a>
    <div class="admin-shell">
        <div class="admin-overlay" x-cloak x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"></div>
        <aside class="admin-sidebar" :class="{ 'is-open': sidebarOpen }" aria-label="Administration sidebar">
            <div class="admin-sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" aria-label="THE IMPACT dashboard"><x-brand-logo /></a>
                <button type="button" class="admin-sidebar-close" @click="sidebarOpen = false" aria-label="Close menu">×</button>
            </div>
            <div class="admin-identity">
                <span class="admin-avatar">SA</span>
                <span><strong>{{ auth()->user()->name }}</strong><small>Super administrator</small></span>
            </div>
            <nav class="admin-menu" aria-label="Dashboard navigation">
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
            <form action="{{ route('admin.logout') }}" method="POST" class="admin-logout">
                @csrf
                <button type="submit"><span aria-hidden="true">↪</span> Sign out</button>
            </form>
        </aside>
        <div class="admin-workspace">
            <header class="admin-topbar">
                <button type="button" class="admin-menu-toggle" @click="sidebarOpen = true" aria-label="Open menu">☰</button>
                <div><small>THE IMPACT</small><strong>Content administration</strong></div>
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View website <span aria-hidden="true">↗</span></a>
            </header>
            <main id="admin-main" class="admin-main">@isset($slot){{ $slot }}@else @yield('content') @endisset</main>
        </div>
    </div>
    <div
        class="admin-toast-region"
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
            <div class="admin-toast animate__animated animate__fadeInRight" :class="toast.type === 'error' ? 'admin-toast-error' : ''" role="status">
                <span class="admin-toast-icon" :class="toast.type === 'error' ? 'admin-toast-error-icon' : ''" aria-hidden="true">
                    <svg x-show="toast.type === 'success'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 12 4 4L19 6" /></svg>
                    <svg x-show="toast.type !== 'success'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v5m0 3h.01" /><circle cx="12" cy="12" r="9" /></svg>
                </span>
                <span class="admin-toast-copy"><strong x-text="toast.type === 'success' ? 'Done' : 'Notice'"></strong><span x-text="toast.message"></span></span>
                <button type="button" @click="remove(toast.id)" aria-label="Dismiss notification">×</button>
            </div>
        </template>
    </div>
    @livewireScripts
</body>
</html>
