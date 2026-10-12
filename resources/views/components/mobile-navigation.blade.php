<nav class="app-nav fixed inset-x-0 bottom-0 z-50 grid grid-cols-5 gap-0.5 border-t border-line bg-paper p-2 shadow-2xl lg:hidden [&_a]:flex [&_a]:min-h-13 [&_a]:flex-col [&_a]:items-center [&_a]:justify-center [&_a]:gap-1 [&_a]:rounded-xl [&_a]:text-[10px] [&_a]:font-semibold [&_a]:text-muted [&_svg]:size-5" aria-label="Quick navigation">
    @foreach([
        ['route' => 'home', 'label' => 'Home', 'icon' => 'home', 'active' => request()->routeIs('home')],
        ['route' => 'about', 'label' => 'About', 'icon' => 'faith', 'active' => request()->routeIs('about', 'about.*')],
        ['route' => 'programmes.index', 'label' => 'Learn', 'icon' => 'equip', 'active' => request()->routeIs('programmes.*')],
        ['route' => 'mentorship', 'label' => 'Mentorship', 'icon' => 'mentor', 'active' => request()->routeIs('mentorship')],
        ['route' => 'leadership', 'label' => 'Leaders', 'icon' => 'connect', 'active' => request()->routeIs('leadership')],
    ] as $item)
        <a href="{{ route($item['route']) }}" @if($item['active']) class="is-current bg-[#f1e7ec] text-ink" aria-current="page" @endif><x-icon :name="$item['icon']" /><span>{{ $item['label'] }}</span></a>
    @endforeach
</nav>
