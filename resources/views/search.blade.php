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
          <div class="form-group">
            <select class="selezione_raggio" name="radius">
              <option value="radius_select">Seleziona raggio: </option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="80">80</option>
              <option value="100">100</option>
              <option value="150">150</option>
            </select>
          </div>
          <button type="submit" id = "search_button" > <i class="fas fa-search"></i> </button>
        </form>
      </div>
    </div>

    <div class="services">
      <div class="form-group">
        <ul class="list-group list-unstyled">
          <label>Servizi</label>
          <li><label><input class="mr-2" type="checkbox" autocomplete="off" name="wifi" value="0"/>Wifi</label></li>
          <li><label><input class="mr-2" type="checkbox" autocomplete="off" name="parking" value="0"/>Parcheggio</label></li>
          <li><label><input class="mr-2" type="checkbox" autocomplete="off" name="pool" value="0"/>Piscina</label></li>
          <li><label><input class="mr-2" type="checkbox" autocomplete="off" name="concierge" value="0"/>Portineria</label></li>
          <li><label><input class="mr-2" type="checkbox" autocomplete="off" name="sauna" value="0"/>Sauna</label></li>
          <li><label><input class="mr-2" type="checkbox" autocomplete="off" name="sea_view" value="0"/>Vista mare</label></li>
        </ul>
      </div>
    </div>



  </div>



  <div class="flat_box">
    <img src="https://dummyimage.com/100x100/fff/aaa" alt="">
    <h3 id = "flat_title">Titolo: </h3>
    <small id = "flat_address">Indirizzo: </small>
    <p id = "flat_description">Descrizione: </p>
    <small id = "flat_price">Prezzo: </small>
  </div>
@stop
