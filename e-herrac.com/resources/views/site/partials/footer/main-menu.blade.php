<ul class="text-xl">
    @foreach($items as $counter => $item)
        <li>
            <a href="{{$item->url}}" target="{{ $item->target }}">{{ $item->label }}</a>
        </li>
    @endforeach
</ul>
