<ol class="about-values">
    @foreach(config('impact.philosophy') as $value)
        <li><span class="value-index">0{{ $loop->iteration }}</span><div><h3>{{ $value['name'] }}</h3><p>{{ $value['description'] }}</p></div></li>
    @endforeach
</ol>
