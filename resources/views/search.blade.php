@extends('index')

@section('title')
  Ricerca
@endsection

@section('class')
 search
@endsection

@section('content')

  <div class="container">
    <div class="row">
      {{-- ricerca  indirizzo--}}
      <div class="box_ricerca col-md-12">
        <div class="input_ricerca col-md-12">
          <form method="post" class = "col-md-12" enctype="multipart/form-data" action="{{ route('search') }}">
            @csrf

            <input id="address" type="text" class = "col-md-4" name="address" value="{{ old('address') }}" placeholder="Inserisci Indirizzo">
            <button id="geolocate_button" class = "col-md-2" type="button" name="button">Verifica Indirizzo</button>

            <div id="risposta" class = "col-md-5">
              <select class="selectaddress hidden col-md-12" name="">
                <option value="Seleziona l'indirrizzo corretto">Seleziona Indirizzo</option>
              </select>
            </div>

            <div class="form-group">
              <input type="hidden"  id = "ricerca_lat" name="lat" value="
              @php
                $lat = $_POST['lat'];
                echo "$lat";
              @endphp">
            </div>
            <div class="form-group">
              <input type="hidden"  id = "ricerca_long"  name="lon" value="
              @php
                $lon = $_POST['lon'];
                echo "$lon";
              @endphp">
            </div>
            <div class="form-group">
              <input type="hidden"  id = "ricerca_raggio"  name="radius" value="20">
            </div>
            <button type="submit" id = "search_button" > <i class="fas fa-search"></i> </button>
          </form>
        </div>
      </div>
    </div>

  </div>

  <div class="container mt-5">
    <div class="row filter_row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class = "get_filter_responsive hidden_filter">Visualizza filtri <i class="fas fa-chevron-down"></i></div>

        <div class="filter">

          <div class="filter-slider">
            <div class="radius-slider slider-margin">
              <p>
                <label for="maximum_radius">Raggio di ricerca: </label>
                <input type="text" name = "radius" class="slider_input" id="maximum_radius" readonly>
                <span> km</span>
              </p>
              <div id="radius_range"></div>
            </div>

            <form id = "filter-form" method="post" data-route ="{{route('filters')}}">
            @csrf
              <div class="room-slider slider-margin">
                <p>
                  <label for="maximum_room">Stanze: </label>
                  <input type="text" name = "room" class="slider_input" id="maximum_room" readonly>
                </p>
                <div id="room_range"></div>
              </div>

              <div class="bed-slider slider-margin">
                <p>
                  <label for="maximum_bed">Posti letto: </label>
                  <input type="text" name = "bed" class="slider_input" id="maximum_bed" readonly>
                </p>
                <div id="bed_range"></div>
              </div>

            </div>

            {{-- filtri servizi --}}
            <div class="services">
              <div class="form-group">
                <ul class="list-group list-unstyled">
                  <label id = "service_label">Servizi</label>
                  <li><label><input class="mr-2 wifi filter_checkbox" type="checkbox" autocomplete="off" name="wifi" value="0"/>Wifi</label></li>
                  <li><label><input class="mr-2 parking filter_checkbox" type="checkbox" autocomplete="off" name="parking" value="0"/>Parcheggio</label></li>
                  <li><label><input class="mr-2 pool filter_checkbox" type="checkbox" autocomplete="off" name="pool" value="0"/>Piscina</label></li>
                  <li><label><input class="mr-2 concierge filter_checkbox" type="checkbox" autocomplete="off" name="concierge" value="0"/>Portineria</label></li>
                  <li><label><input class="mr-2 sauna filter_checkbox" type="checkbox" autocomplete="off" name="sauna" value="0"/>Sauna</label></li>
                  <li><label><input class="mr-2 sea_view filter_checkbox" type="checkbox" autocomplete="off" name="sea_view" value="0"/>Vista mare</label></li>
                </ul>
              </div>
            </div>
            {{-- <button type="submit">filtra</button> --}}
        </form>
        <div class="filter_reset">
          <button type="button" name="button" class ="btn btn-secondary reset_filter_button button">Resetta filtri</button>
        </div>
        </div>
      </div>
      {{-- container appartamenti --}}
      <div class="col-sm-12 col-md-8 appartamenti-filtrati">
       @forelse ($filtered_flat as $filtered)
           <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
             <div class="flat_box appartamento-@php $i = 0; echo($i++); @endphp">
               <h3 id = "flat_title">{{ $filtered->title }}</h3>
               <div class="img_info_flat">
                 <img src="https://dummyimage.com/100x100/fff/aaa" alt="">
                 <div class="info_flat">
                   <small id = "flat_address">{{ $filtered->address }} <i class="fas fa-map-marked"></i> </small>
                   <small id= "flat_bed">{{$filtered->bed}} <i class="fas fa-bed"></i></small>
                   <small id= "flat_room"> {{$filtered->room}} <i class="fas fa-building"></i></small>
                   <small id = "flat_price"><i class="fas fa-euro-sign"></i> <span>{{ $filtered->price }}</span> per notte</small>
                 </div>
               </div>
               <p id = "flat_description">{{ $filtered->description }}</p>
             </div>
           </div>
      @empty
        <div class="col-md-6 offset-md-3">
          <h3 class="text-warning">Nessun risultato</h3>
        </div>
      @endforelse
    </div>

    </div>
  </div>
@stop

@section('handlebars')
  <script id="template" type="text/x-handlebars-template">
    <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
      <div class="flat_box appartamento-@{{counter}}">
        <h3 id = "flat_title">@{{title}}</h3>
        <div class="img_info_flat">
          <img src="https://dummyimage.com/100x100/fff/aaa" alt="">
          <div class="info_flat">
            <small id = "flat_address" data-lat ="@{{lan}}" data-lon ="@{{lon}}">@{{address}} <i class="fas fa-map-marked"></i> </small>
            <small id= "flat_bed">@{{bed}} <i class="fas fa-bed"></i></small>
            <small id= "flat_room"> @{{room}} <i class="fas fa-building"></i></small>
            <small id = "flat_price"><i class="fas fa-euro-sign"></i> <span>@{{price}}</span> per notte</small>
          </div>
        </div>
        <p id = "flat_description">@{{description}}</p>
      </div>
    </div>
  </script>
@endsection
