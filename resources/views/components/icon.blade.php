@props(['name'])

<svg {{ $attributes->class(['icon']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
    @switch($name)
        @case('home')
            <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1Z" />
            @break
        @case('governance')
            <path d="m3 9 9-6 9 6H3Zm2 3v7m5-7v7m4-7v7m5-7v7M3 21h18" />
            @break
        @case('policy')
            <path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9l-6-6Zm0 0v6h6M8 13h8m-8 4h5" />
            @break
        @case('leadership')
        @case('compass')
            <circle cx="12" cy="12" r="9" /><path d="m16 8-2 6-6 2 2-6 6-2Z" />
            @break
        @case('service')
            <path d="m12 11-4-4a2.8 2.8 0 0 1 4-4 2.8 2.8 0 0 1 4 4l-4 4ZM3 14h4l3 2h4a2 2 0 0 1 0 4h-4m6-3 3-2a2 2 0 0 1 2 3l-5 4H8l-5-3M3 13v8" />
            @break
        @case('growth')
            <path d="M12 21v-9M12 15C5 15 3 11 3 5c6 0 9 3 9 10Zm0-3c0-6 3-9 9-9 0 6-3 9-9 9Z" />
            @break
        @case('identify')
            <circle cx="10" cy="10" r="6" /><path d="m15 15 6 6m-14-11 2 2 4-4" />
            @break
        @case('connect')
            <circle cx="8" cy="7" r="3" /><path d="M2 21v-3a6 6 0 0 1 12 0v3M16 4a3 3 0 0 1 0 6m2 4a5 5 0 0 1 3 4v3" />
            @break
        @case('equip')
            <path d="M12 5v16M3 3c4 0 7 1 9 3 2-2 5-3 9-3v15c-4 0-7 1-9 3-2-2-5-3-9-3V3Z" />
            @break
        @case('mentor')
            <path d="M21 11a8 8 0 0 1-8 8H6l-4 3V11a9 9 0 0 1 18 0ZM7 10h9m-9 4h5" />
            @break
        @case('deploy')
            <path d="m3 10 18-7-7 18-3-8-8-3Zm8 3L21 3" />
            @break
        @case('faith')
            <path d="M10 3h4v5h5v4h-5v9h-4v-9H5V8h5V3Z" />
            @break
        @default
            <path d="M5 19 19 5M5 5h14v14" />
    @endswitch
</svg>
