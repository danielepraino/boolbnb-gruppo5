<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/333654a8dc.js"></script>

    {{-- leaflet map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
          <!-- Make sure you put this AFTER Leaflet's CSS -->
   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
     integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
     crossorigin=""></script>

    <!-- Styles -->
    <title>BoolBnB @yield('title')</title>
  </head>
  <body>
    {{-- Header --}}
    @include('layouts._header')

    {{-- Contenuto principale pagine--}}
      <div class="container main_content @yield('home')">
        @yield('content')
      </div>

    {{-- Contenuto appartamenti in evidenza home--}}
      @yield('appartamenti_in_evidenza')

    {{-- Footer --}}
    @include('layouts._footer')

  <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
  </body>
</html>
