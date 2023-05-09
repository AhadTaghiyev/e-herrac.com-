<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{env('APP_NAME')}}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="{{asset('assets/styles/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fonts/icomoon/style.css')}}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NJ9KB9DV8V"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-NJ9KB9DV8V');
    </script>
  </head>
  <body class="bg-gray-100">
    <!-- Header -->
    <header class="flex bg-white h-24">
        <div class="px-4 max-w-5xl mx-auto w-full flex items-center">
            <a href="{{route('home')}}" class="flex py-2 mr-4 h-20">
                <img class="h-full w-auto" src="{{asset('assets/images/logo.png')}}" />
            </a>
            <div class="flex items-center lg:ml-0 ml-auto relative">
                <button id="header-menu-button" class="lg:hidden focus:outline-none text-xl">
                    <span class="icon-hamburger"></span>
                </button>
                @includeWhen(isset($menus['header']), 'site.partials.header.main-menu', ['items' => $menus['header']])
            </div>
        </div>
    </header>
    @yield('content')
    <footer>
        <div class="bg-white py-16">
            <div class="px-4 max-w-5xl mx-auto w-full grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <h4 class="text-2xl text-gray-500 px-4 border-l-2 border-gray-500 mb-4">Əlaqə</h4>
                    <p class="text-xl">{{$_PAGES['contact']->getMeta('phone')}}</p>
                    <p class="text-xl">{{$_PAGES['contact']->getMeta('email')}}</p>
                </div>
                <div>
                    <h4 class="text-2xl text-gray-500 px-4 border-l-2 border-gray-500 mb-4">Ünvan</h4>
                    <p class="text-xl">{{$_PAGES['contact']->getMeta('address')}}</p>
                </div>
                <div>
                    <h4 class="text-2xl text-gray-500 px-4 border-l-2 border-gray-500 mb-4">Kateqoriyalar</h4>
                    @includeWhen(isset($menus['footer']), 'site.partials.footer.main-menu', ['items' => $menus['footer']])
                </div>
                <div>
                    <h4 class="text-2xl text-gray-500 px-4 border-l-2 border-gray-500 mb-4">Saytın xəritəsi</h4>
                    <ul class="text-xl">
                        <li><a href="#">Ana səhifə</a></li>
                        <li><a href="#">Haqqımızda</a></li>
                        <li><a href="#">Online hərrac</a></li>
                        <li><a href="#">Qanunvericilik</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-black">
            <div class="flex flex-wrap h-16 items-center max-w-5xl mx-auto px-4 text-white w-full">
                <p>Copyright &copy; {{date('Y')}} Bütün hüquqlar qorunur</p>
                <p class="md:ml-auto ml-0">Azərbaycan Respublikası Əmlak Hərrac Mərkəzi</p>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{asset('assets/scripts/main.js')}}"></script>
  </body>
</html>
