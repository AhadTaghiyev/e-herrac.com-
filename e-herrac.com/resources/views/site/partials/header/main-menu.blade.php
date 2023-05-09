@if(!isset($innerLoop))
    <ul id="header-menu" class="overflow-y-auto md:overflow-y-visible hidden lg:flex bg-white bottom-0 fixed flex flex-col left-0 lg:flex-row lg:static right-0 top-16 z-50">
@elseif($innerLoop === 1)
    <ul {{$innerLoop}} class="submenu bg-white z-50 border-t border-b lg:border-t-0 lg:border-b-0 lg:absolute lg:top-full lg:left-0">
@else
    <ul {{$innerLoop}} class="submenu bg-white z-50 border-t border-b lg:border-t-0 lg:border-b-0 lg:absolute lg:top-0 lg:left-full">
@endif
    @foreach($items as $counter => $item)
        @if( !isset($innerLoop))
            <li class="inline-flex flex-col {{!$item->childs->isEmpty() ? 'has-submenu' : ''}}">
                <a class="{{$item->is_current ? 'bg-blue-500 text-white' : ''}} whitespace-nowrap inline-flex h-16 md:h-24 items-center" href="{{$item->url}}" target="{{ $item->target }}">
                    <span class="{{ !$loop->last ? 'lg:border-r' : '' }} border-gray-400 border-r-0 px-4">{{ $item->label }} {!! !$item->childs->isEmpty() ? '<span>&nbsp;&darr;</span>' : '' !!}</span>
                </a>
        @else
            <li class="{{!$item->childs->isEmpty() ? 'has-submenu' : ''}}">
                <a href="{{$item->url}}" target="{{ $item->target }}">
                    {{ $item->label }} {!! !$item->childs->isEmpty() ? '<span>&rarr;</span>' : '' !!}
                </a>
        @endif
            @if(!$item->childs->isEmpty())
                @include('site.partials.header.main-menu', ['items' => $item->childs, 'innerLoop' => (isset($innerLoop) ? $innerLoop + 1 : 1)])
            @endif
        </li>
    @endforeach
    </ul>
