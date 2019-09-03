<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/333654a8dc.js"></script>
    <title>BoolBnB @yield('title')</title>
  </head>
  <body>
    {{-- Header --}}
    @include('layouts._header')


    {{-- Contenuto ricerca appartamento --}}
      <div class="container main_content">
        @yield('content')
      </div>

    {{-- Contenuto appartamenti in evidenza --}}
    <div class="container appartamenti_in_evidenza">
      @yield('appartamenti_in_evidenza')
    </div>

    {{-- Footer --}}
    @include('layouts._footer')
  <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
  </body>
</html>
