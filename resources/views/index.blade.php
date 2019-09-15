<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/333654a8dc.js"></script>

    {{-- handlebars --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script>


    {{-- leaflet map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
          <!-- Make sure you put this AFTER Leaflet's CSS -->
   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
     integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
     crossorigin=""></script>
     <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Styles -->
    <title>BoolBnB @yield('title')</title>
  </head>
  <body>
    {{-- Header --}}
    @include('layouts._header')

    {{-- Contenuto principale pagine--}}
      <div class="container-fluid main_content @yield('class')">
        @yield('content')
      </div>

    {{-- Contenuto appartamenti in evidenza home--}}
      @yield('appartamenti_in_evidenza')
      @yield('appartamenti')



      <div class="scroll_top hidden">
        <i class="fas fa-chevron-up fa-2x"></i>
      </div>
    {{-- Footer --}}
    @include('layouts._footer')

    @yield('handlebars')

  <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
  </body>
</html>
