@extends('site.layouts.app')

@section('content')
<main class="py-16">
    <div class="px-4 max-w-5xl mx-auto w-full">
        <ul class="flex mb-8 text-sm md:text-lg">
          <li><a class="hover:text-blue-500 transition-colors" href="{{route('home')}}">Ana Səhifə</a></li>
          <li><span class="mx-3">&rang;</span></li>
          <li>{{$page->name}}</li>
        </ul>
      </div>
    <div class="px-4 max-w-5xl mx-auto w-full flex">
        <h1 class="text-3xl mb-4 pb-4 border-b border-gray-300 w-full text-gray-700">Əlaqə</h1>
    </div>
    <div class="px-4 max-w-5xl mx-auto w-full flex flex-col lg:flex-row gap-6">
        <div class="flex-1">
            <form class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-lg text-gray-500 mb-3 inline-block" for="name">Ad <span class="text-red-500">*</span></label>
            <input
              name="name"
              id="name"
              required
              class="w-full rounded p-2 focus:outline-none focus:border-blue-500 border-gray-300 border bg-transparent"
            />
          </div>
          <div>
            <label
              class="text-lg text-gray-500 mb-3 inline-block"
              for="surname"
              >Soyad <span class="text-red-500">*</span></label
            >
            <input
              name="surname"
              id="surname"
              required
              class="w-full rounded p-2 focus:outline-none focus:border-blue-500 border-gray-300 border bg-transparent"
            />
          </div>
          <div class="col-start-1 col-end-3">
            <label class="text-lg text-gray-500 mb-3 inline-block" for="email"
              >E-poçt <span class="text-red-500">*</span></label
            >
            <input
              name="email"
              id="email"
              required
              class="w-full rounded p-2 focus:outline-none focus:border-blue-500 border-gray-300 border bg-transparent"
            />
          </div>
          <div class="col-start-1 col-end-3">
            <label
              class="text-lg text-gray-500 mb-3 inline-block"
              for="message"
              >Mətn <span class="text-red-500">*</span></label
            >
            <textarea
              rows="8"
              name="message"
              id="message"
              required
              class="w-full rounded p-2 focus:outline-none focus:border-blue-500 border-gray-300 border bg-transparent"
            ></textarea>
          </div>
          <div>
            <button
              class="w-full p-2 rounded bg-blue-500 text-white focus:outline-none"
              type="submit"
            >
              Göndər
            </button>
          </div>
        </form>
      </div>
      <div class="flex-1">
        <div class="mapouter" style="width: 100%">
          <div class="gmap_canvas" style="width: 100%">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d189.98271476555004!2d49.8107469!3d40.3706563!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307dc2eab2be39%3A0x908b6d930484dda4!2zQmV5bsmZbHhhbHEgS29tbWVyc2l5YSBBcmJpdHJhaiBNyZloa8mZbcmZc2k!5e0!3m2!1saz!2s!4v1617308756735!5m2!1saz!2s"
                style="width: 100%;height:100%;"
                allowfullscreen=""
                id="gmap_canvas"
                loading="lazy">
            </iframe>
            <style>
              .mapouter {
                position: relative;
                text-align: right;
                height: 500px;
                width: 500px;
              }
              .gmap_canvas {
                overflow: hidden;
                background: none !important;
                height: 500px;
                width: 500px;
              }
            </style>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@push('js_libs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
@endpush

@push('js_inline')

@endpush
