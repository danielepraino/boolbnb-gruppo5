<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>BoolBnB @yield('title')</title>
  </head>
  <body>
    {{-- Header --}}
    @include('layouts._header')


    {{-- Contenuto principale pagina --}}
      <div class="container">
        @yield('content')
      </div>


    {{-- Footer --}}
    @include('layouts._footer')
  <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
  </body>
</html>
