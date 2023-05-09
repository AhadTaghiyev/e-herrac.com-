@extends('site.layouts.app')

@section('content')
<main class="pb-16">
    @if($data['slides']->count())
        <!-- Home Slider -->
        <div class="py-4">
            <div class="px-4 max-w-5xl mx-auto w-full">
                <div id="home-slider">
                    @foreach($data['slides'] as $slide)
                        <a target="_blank" href="{{$slide->url}}" class="relative w-full">
                            <img class="w-full" src="{{$slide->getFirstMediaUrl('image')}}" />
                            <div class="absolute top-0 right-0 bottom-0 left-0 bg-gray-900 bg-opacity-75 flex flex-col items-center justify-center">
                                <h2 class="border-b border-t border-t-2 border-white md:text-4xl py-6 text-center text-sm text-white text-whiteborder-b-2">{{$slide->title}}</h2>
                                <p class="md:text-2xl my-2 text-sm text-white">{{$slide->description}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Home Search -->
    <div class="py-6">
        <div class="px-4 flex justify-center max-w-5xl mx-auto w-full">
            <form class="bg-white rounded-2xl shadow-lg" action="{{route('home')}}">
                <input class="bg-transparent focus:outline-none md:w-96 px-6 py-3 text-xl w-24 xs:w-32" placeholder="Axtarış" type="text" name="query"/>
                <select name="category" class="bg-transparent border-gray-400 border-l cursor-pointer focus:outline-none md:pr-6 md:w-48 pr-0 px-6 py-2 w-28">
                    <option value="">Hamısı</option>
                    {{buildTreeSelect($data['categories'])}}
                </select>
                <button class="focus:outline-none bg-blue-500 h-full ml-4 px-6 rounded-r-2xl text-white text-xl">Axtar</button>
            </form>
        </div>
    </div>

    <!-- Home Auction Section -->
    <div class="my-6">
        <div class="px-4 max-w-5xl mx-auto w-full grid grid-cols-3 gap-6">
            <!-- Filters -->
            <div class="col-end-4 col-start-1 md:col-end-2 md:row-end-2 md:row-start-1 row-end-3 row-start-2">
                <!-- Auction dates -->
                <div class="bg-white p-2 rounded mb-6">
                    <div id="auction-dates-tabs">
                        <div id="auction-dates-buttons" class="flex justify-center pb-2 border-b border-gray-400 mb-2">
                            <button class="rounded-full focus:outline-none px-5 py-1 text-white bg-blue-500">İlkin hərrac</button>
                            <button class="rounded-full focus:outline-none px-5 py-1">Təkrar hərrac</button>
                        </div>
                        <div id="tabs-content">
                            <div>
                                <ul>
                                    @foreach($data['auctions']['new'] as $auction)
                                        <li>
                                            <button class="mb-2 p-2 border border-gray-300 w-full rounded flex items-center focus:outline-none text-gray-500">
                                                <span class="icon-hammer mr-2"></span><span>{{$auction->date->format('d/m/Y')}}</span>
                                                @if(!is_null($auction->time))
                                                    <span class="ml-auto py-1 px-3 bg-blue-500 text-white rounded">{{\Carbon\Carbon::parse($auction->time)->format('H:i')}}</span>
                                                @endif
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- <p class="text-center"><a class="text-blue-500 text-sm" href="#">Daha çox göstər</a></p> --}}
                            </div>
                            <div class="hidden">
                                <ul>
                                    @foreach($data['auctions']['repeated'] as $auction)
                                        <li>
                                            <button class="mb-2 p-2 border border-gray-300 w-full rounded flex items-center focus:outline-none text-gray-500">
                                                <span class="icon-hammer mr-2"></span><span>{{$auction->date->format('d/m/Y')}}</span>
                                                @if(!is_null($auction->time))
                                                    <span class="ml-auto py-1 px-3 bg-blue-500 text-white rounded">{{\Carbon\Carbon::parse($auction->time)->format('H:i')}}</span>
                                                @endif
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- <p class="text-center"><a class="text-blue-500 text-sm" href="#">Daha çox göstər</a></p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Selected auctions -->
                <div class="bg-white p-2 rounded mb-6">
                    <div class="flex pb-2 border-b border-gray-400 mb-2">
                        <h3 class="text-left text-xl">Seçilmişlər</h3>
                    </div>
                    <ul>
                        @foreach($data['featured_advetisements'] as $advertisement)
                            <li class="mb-2">
                                <a class="flex" href="{{route('advertisement', [$advertisement->category->path, $advertisement->slug])}}">
                                    <img class="w-1/3" src="{{$advertisement->getFirstMediaUrl('image', '900x600')}}" alt="" />
                                    <div class="border-b border-r border-t flex-1 p-2">
                                        <h4 class="text-base">{{$advertisement->name}}</h4>
                                        <div class="flex my-1 text-gray-500 text-xs">
                                            <div class="flex items-center">
                                                <span class="icon-placeholder mr-1"></span>
                                                <span>{{$advertisement->region->name}}</span>
                                            </div>
                                            <div class="ml-auto flex items-center">
                                                <span class="icon-calendar mr-1"></span>
                                                <span>{{$advertisement->auction->date->format('d/m/Y')}}</span>
                                            </div>
                                        </div>
                                        <div class="text-blue-500 text-right">{{number_format($advertisement->price)}} {{App\Models\Advertisement::$currencies[$advertisement->currency]}}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Auction List -->
            <div class="md:col-start-2 col-end-4 col-start-1">
                <div class="auto-rows-min gap-6 grid grid-cols-2 md:grid-cols-3">
                    @foreach($data['advertisements'] as $advertisement)
                        <a href="{{route('advertisement', [$advertisement->category->path, $advertisement->slug])}}" class="bg-white overflow-hidden rounded shadow-lg transition hover:shadow-xl">
                            <div class="relative">
                                <img src="{{$advertisement->getFirstMediaUrl('image', '900x600')}}" />
                                <span class="absolute bg-blue-500 text-white py-1 px-2 bottom-0 right-0">{{number_format($advertisement->price)}} {{App\Models\Advertisement::$currencies[$advertisement->currency]}}</span>
                            </div>
                            <div class="bg-white w-full flex flex-col">
                                <h4 class="leading-6 mt-2 px-2 text-center text-lg">{{$advertisement->name}}</h4>
                                <p class="flex p-2 text-gray-500 text-sm">
                                    <span>{{$advertisement->region->name}}</span>
                                    <span class="ml-auto">{{$advertisement->auction->date->format('d/m/Y')}}</span>
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $data['advertisements']->links('pagination::simple-tailwind') }}
            </div>
        </div>
    </div>
</main>
@endsection
