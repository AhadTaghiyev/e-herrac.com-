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
        <div
          class="col-end-4 col-start-1 md:col-end-2 md:row-end-2 md:row-start-1 row-end-3 row-start-2"
        >
          <!-- Category Filters -->
          <div class="mb-4 pb-4 border-b border-gray-300">
            <form>
              <div class="flex gap-4 mb-4">
                <input
                  class="w-1/2 p-2 bg-white border-gray-300 focus:border-blue-500 focus:outline-none border text-sm rounded"
                  type="text"
                  name="min_price"
                  placeholder="Qiymət(min)"
                />
                <input
                  class="w-1/2 p-2 bg-white border-gray-300 focus:border-blue-500 focus:outline-none border text-sm rounded"
                  type="text"
                  name="max_price"
                  placeholder="Qiymət(max)"
                />
              </div>
              <div
                class="flex flex-col items-start mb-4 text-lg text-gray-500"
              >
                <label class="cursor-pointer">
                  <input type="radio" name="auction_type" checked /> Birbaşa
                  satış</label
                >
                <label class="cursor-pointer">
                  <input type="radio" name="auction_type" /> Hərrac</label
                >
              </div>
              <div>
                <button
                  class="w-full bg-blue-500 text-white py-2 px-4 rounded focus:outline-none"
                >
                  Axtar
                </button>
              </div>
            </form>
          </div>
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
                            <img class="w-1/3" src="{{$advertisement->getFirstMediaUrl('image')}}" alt="" />
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
      </div>
      <div class="w-full md:w-2/3 flex-col md:flex-row flex md:pl-6">
        <div class="w-full">
          <h2 class="text-xl text-gray-700 font-bold border-b pb-4 mb-4 flex items-center">
            Elanlar
            <select class="ml-auto bg-transparent p-2 border rounded border-gray-300 text-sm focus:outline-none">
              <option>tarixə görə</option>
              <option>əvvəlcə ucuz</option>
              <option>əvvəlcə bahalı</option>
            </select>
          </h2>
          <div>
            <p class="border-blue-500 bg-blue-100 border rounded p-2">
              {{$advertisements->total()}} elan tapildi
            </p>
          </div>
          <div class="mt-6 mb-4 auto-rows-min gap-6 grid grid-cols-2 md:col-start-2 md:grid-cols-3">
          @foreach($advertisements as $advertisement)
            <a href="{{route('advertisement', [$advertisement->category->path, $advertisement->slug])}}" class="overflow-hidden rounded shadow-lg transition hover:shadow-xl">
              <div class="relative">
                <img src="{{$advertisement->getFirstMediaUrl('image')}}" />
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
          {{-- <div class="flex justify-center items-center">
            <a href="#" class="bg-blue-500 focus:outline-none text-white py-2 px-6 rounded mr-4">&lang;</a>
            <div class="text-lg">
              <span>1</span>
              <span>/</span>
              <span>5</span>
            </div>
            <a href="#" class="bg-blue-500 focus:outline-none text-white py-2 px-6 rounded ml-4">&rang;</a>
          </div> --}}
        </div>
      </div>
    </div>
  </main>
@endsection
