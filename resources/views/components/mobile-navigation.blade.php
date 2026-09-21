<nav class="app-nav" aria-label="Quick navigation">
    @foreach([
        ['route' => 'home', 'label' => 'Home', 'icon' => 'home', 'active' => request()->routeIs('home')],
        ['route' => 'about', 'label' => 'About', 'icon' => 'faith', 'active' => request()->routeIs('about', 'about.*')],
        ['route' => 'programmes.index', 'label' => 'Learn', 'icon' => 'equip', 'active' => request()->routeIs('programmes.*')],
        ['route' => 'mentorship', 'label' => 'Mentorship', 'icon' => 'mentor', 'active' => request()->routeIs('mentorship')],
        ['route' => 'leadership', 'label' => 'Leaders', 'icon' => 'connect', 'active' => request()->routeIs('leadership')],
    ] as $item)
        <a href="{{ route($item['route']) }}" @if($item['active']) class="is-current" aria-current="page" @endif><x-icon :name="$item['icon']" /><span>{{ $item['label'] }}</span></a>
    @endforeach
</nav>
