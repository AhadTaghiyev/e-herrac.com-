<ul class="topbar-sosmed">
    @foreach($items as $item)
        <li>
            <a href="{{$item->url}}"><i class="{{ $item->class }}"></i></a>
        </li>
    @endforeach
</ul>