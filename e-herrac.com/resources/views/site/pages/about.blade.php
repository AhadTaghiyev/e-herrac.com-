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
    <div class="px-4 max-w-5xl mx-auto w-full">
      <h1 class="text-3xl mb-4 pb-2 border-b border-gray-300 text-gray-700">
        {{$page->name}}
      </h1>
      <div id="single-page-content">
        {!!$page->content!!}
      </div>
    </div>
  </main>
@endsection
