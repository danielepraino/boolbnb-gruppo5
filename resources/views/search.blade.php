@extends('index')

@section('title')
  Ricerca
@endsection

@section('content')
  <div class="container">

    {{-- ricerca  indirizzo--}}
    <div class="box_ricerca">
      <div class="input_ricerca">

        <input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="Inserisci Indirizzo">
        <button id="geolocate_button" type="button" name="button">Daje</button>

        <div id="risposta">
          <select class="selectaddress hidden" name="">
            <option value="Seleziona l'indirrizzo corretto">Seleziona Indirizzo</option>
          </select>
        </div>

        <form method="get" enctype="multipart/form-data" action="{{ route('search') }}">
          @csrf
          <div class="form-group">
            <input type="hidden"  id = "ricerca_lat" placeholder="Inserisci la latitudine" name="lat" value="">
          </div>
          <div class="form-group">
            <input type="hidden"  id = "ricerca_long" placeholder="Inserisci la longitude" name="lon" value="">
          </div>
          {{-- <div class="form-group">
            <select class="selezione_raggio" name="radius">
              <option value="radius_select">Seleziona raggio: </option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="80">80</option>
              <option value="100">100</option>
              <option value="150">150</option>
            </select>
          </div> --}}
          <button type="submit" id = "search_button" > <i class="fas fa-search"></i> </button>
        </form>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-3">
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
                  <label>Servizi</label>
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
        </div>
      </div>

      <div class="col-md-9">
        <div class="flat_box">
          <img src="https://dummyimage.com/100x100/fff/aaa" alt="">
          <h3 id = "flat_title">Titolo: </h3>
          <small id = "flat_address">Indirizzo: </small>
          <p id = "flat_description">Descrizione: </p>
          <small id = "flat_price">Prezzo: </small>
        </div>
      </div>
    </div>
  </div>
@stop
