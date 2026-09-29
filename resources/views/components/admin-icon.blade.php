@props(['name'])

<svg {{ $attributes->class(['admin-icon']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('dashboard') <path d="M4 13h6V4H4v9Zm10 7h6V11h-6v9ZM4 20h6v-3H4v3Zm10-13h6V4h-6v3Z" /> @break
        @case('home') <path d="m3 10 9-7 9 7v10H14v-6h-4v6H3V10Z" /> @break
        @case('about') <circle cx="12" cy="12" r="9" /><path d="M12 11v6m0-10h.01" /> @break
        @case('vision') <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" /><circle cx="12" cy="12" r="2.5" /> @break
        @case('philosophy') <path d="M9 18h6m-5 3h4M8 14c-1.2-1-2-2.7-2-4.5a6 6 0 0 1 12 0c0 1.8-.8 3.5-2 4.5-.8.7-1 1.3-1 2H9c0-.7-.2-1.3-1-2Z" /> @break
        @case('programmes') <path d="M4 5h7v14H4V5Zm9 0h7v14h-7V5ZM7 9h1m8 0h1M7 13h1m8 0h1" /> @break
        @case('cohorts') <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm8-1a2.5 2.5 0 1 0 0-5M2 20v-2a6 6 0 0 1 12 0v2m2-7a5 5 0 0 1 5 5v2" /> @break
        @case('mentorship') <path d="M4 4h16v13H8l-4 3V4Zm4 5h8m-8 4h5" /> @break
        @case('leadership') <circle cx="12" cy="8" r="4" /><path d="M4 21a8 8 0 0 1 16 0M12 3V1m7 7h2M3 8H1" /> @break
        @case('messages') <path d="M4 4h16v13H8l-4 3V4Z" /><path d="M8 9h8m-8 4h5" /> @break
        @case('applications') <path d="M7 3h10v4H7V3ZM5 5H3v16h18V5h-2M8 12h8m-8 4h5" /> @break
        @case('media') <rect x="3" y="4" width="18" height="16" rx="2" /><circle cx="8.5" cy="9" r="1.5" /><path d="m4 17 5-5 4 4 2-2 5 5" /> @break
        @case('seo') <circle cx="10" cy="10" r="6" /><path d="m15 15 6 6M7 10h6m-3-3v6" /> @break
        @case('settings') <circle cx="12" cy="12" r="3" /><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-2.83 2.83-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-4v-.08A1.7 1.7 0 0 0 9 19.37a1.7 1.7 0 0 0-1.88.34l-.06.06-2.83-2.83.06-.06A1.7 1.7 0 0 0 4.63 15 1.7 1.7 0 0 0 3.08 14H3v-4h.08A1.7 1.7 0 0 0 4.63 9a1.7 1.7 0 0 0-.34-1.88l-.06-.06 2.83-2.83.06.06A1.7 1.7 0 0 0 9 4.63 1.7 1.7 0 0 0 10 3.08V3h4v.08A1.7 1.7 0 0 0 15 4.63a1.7 1.7 0 0 0 1.88-.34l.06-.06 2.83 2.83-.06.06A1.7 1.7 0 0 0 19.37 9 1.7 1.7 0 0 0 20.92 10H21v4h-.08A1.7 1.7 0 0 0 19.4 15Z" /> @break
        @case('users') <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m7-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 0 2 2 4-4m-3-3h3v3" /> @break
        @case('external') <path d="M14 3h7v7m0-7-10 10" /><path d="M18 13v7H4V6h7" /> @break
        @default <circle cx="12" cy="12" r="9" />
    @endswitch
</svg>
