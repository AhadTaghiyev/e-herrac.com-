@extends('site.layouts.app')

@section('content')
<main class="py-16">
    <div class="px-4 max-w-5xl mx-auto w-full">
      <ul class="flex mb-8 text-sm md:text-lg">
            @foreach($data['breadcrumb'] as $breadcrumb)
                <li>
                    @if(!$breadcrumb['current'])
                        <a class="hover:text-blue-500 transition-colors" href="{{$breadcrumb['url']}}">{{$breadcrumb['title']}}</a>
                    @else
                        {{$breadcrumb['title']}}
                    @endif
                </li>
                @if(!$breadcrumb['current'])
                    <li>
                        <span class="mx-3">&rang;</span>
                    </li>
                @endif
            @endforeach
      </ul>
    </div>
    <div class="px-4 max-w-5xl mx-auto w-full flex-col md:flex-row flex">
      <div class="w-full md:w-1/3">
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
                @foreach($data['featured_advetisements'] as $featured_advetisement)
                    <li class="mb-2">
                        <a class="flex" href="{{route('advertisement', [$featured_advetisement->category->path, $featured_advetisement->slug])}}">
                            <img class="w-1/3" src="{{$featured_advetisement->getFirstMediaUrl('image', '900x600')}}" alt="" />
                            <div class="border-b border-r border-t flex-1 p-2">
                                <h4 class="text-base">{{$featured_advetisement->name}}</h4>
                                <div class="flex my-1 text-gray-500 text-xs">
                                    <div class="flex items-center">
                                        <span class="icon-placeholder mr-1"></span>
                                        <span>{{$featured_advetisement->region->name}}</span>
                                    </div>
                                    <div class="ml-auto flex items-center">
                                        <span class="icon-calendar mr-1"></span>
                                        <span>{{$featured_advetisement->auction->date->format('d/m/Y')}}</span>
                                    </div>
                                </div>
                                <div class="text-blue-500 text-right">{{number_format($featured_advetisement->price)}} {{App\Models\Advertisement::$currencies[$featured_advetisement->currency]}}</div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
      </div>
      <div class="w-full md:w-2/3 flex-col md:flex-row flex md:pl-6">
        <div class="w-full md:w-1/2 mb-12 md:mb-0">
          <div id="single-page-slider-container">
            <div id="single-page-main-slider" class="mb-2">
                @foreach($advertisement->getMedia('images') as $media)
                    <img class="w-full focus:outline-none" src="{{$media->getFullUrl()}}"/>
                @endforeach
            </div>
            <div id="single-page-thumbnail-slider">
                @foreach($advertisement->getMedia('images') as $media)
                    <img class="w-full focus:outline-none" src="{{$media->getFullUrl('900x600')}}"/>
                @endforeach
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/2 pl-0 md:pl-6">
          <h2 class="text-xl text-gray-700 font-bold border-b pb-4 mb-4">{{$advertisement->name}}</h2>
          <div id="single-page-details-page" class="border-b mb-4 pb-4">
              {!! $advertisement->content !!}
          </div>
          <div class="mb-4">
            <div>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-gray-300">★</span>
            </div>
          </div>
          <div class="mb-6">
            <p class="text-lg text-gray-700">{{$advertisement->note}}</p>
          </div>
          <div class="mb-4">
            <p class="text-3xl text-blue-500">{{number_format($advertisement->price)}} {{App\Models\Advertisement::$currencies[$advertisement->currency]}}</p>
          </div>
          {{-- <div>
            <p class="text-sm text-gray-500">Vaxt bitib!</p>
          </div> --}}
        </div>
      </div>
    </div>
  </main>
@endsection
