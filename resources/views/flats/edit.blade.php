@extends('index')

@section('title')
  Modifica l'appartamento
@endsection

@section('content')
  <div class="container mt-10 mb-5">
    @if (Auth::user()->id == $flat->user_id)
      <h1>Modifica l'appartamento {{ $flat->title }}</h1>
      <form method="post" enctype="multipart/form-data" action="{{ route('flats.update', $flat->id) }}">
        @method("PUT")
        @csrf
        <div class="form-group">
          <label>Titolo</label>
          <input type="text" class="form-control" placeholder="Inserisci il titolo" name="title" value="{{ old("title", $flat->title) }}">
          @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Descrizione</label>
          <textarea class="form-control" placeholder="Inserisci la descrizione dell'appartamento" name="description" rows="5">{{ old("description", $flat->description) }}</textarea>
          @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Stanze</label>
          <input type="text" class="form-control" placeholder="Inserisci il numero di stanze" name="room" value="{{ old("room", $flat->room) }}">
          @error('room')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Letti</label>
          <input type="text" class="form-control" placeholder="Inserisci il numero di letti" name="bed" value="{{ old("bed", $flat->bed) }}">
          @error('bed')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Bagni</label>
          <input type="text" class="form-control" placeholder="Inserisci il numero di bagni" name="bathroom" value="{{ old("bathroom", $flat->bathroom) }}">
          @error('bathroom')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Metri quadri</label>
          <input type="text" class="form-control" placeholder="Inserisci i metri quadri" name="sm" value="{{ old("sm", $flat->sm) }}">
          @error('sm')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Indirizzo</label>
          <input id="address" type="text" name="address" value="{{ old("address", $flat->address) }}" placeholder="Inserisci Indirizzo">
          <button id="geolocate_button" type="button" name="button">Daje</button>

          <div id="risposta">
            <select class="selectaddress hidden" name="">
              <option value="Seleziona l'indirrizzo corretto">Seleziona Indirizzo</option>


            </select>

          </div>

          {{-- <input type="text" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old("address") }}"> --}}
          @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Prezzo di affitto per notte</label>
          <input type="text" class="form-control" placeholder="Inserisci il prezzo di affitto per notte" name="price" value="{{ old("price", $flat->price) }}">
          @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label>Vuoi che l'annuncio sia visibile da subito?<input class="ml-2" type="checkbox" name="visible" @if($flat->visible == 1) checked @endif value="{{ old("visible", $flat->visible) }}"/></label>
        </div>

        <div class="form-group">
          <ul class="list-group list-unstyled">
            <label>Servizi</label>
            <li><label><input class="mr-2" type="checkbox" name="services[wifi]" @if($services->wifi == 1) checked @endif value="{{ old("services[wifi]", $services->wifi) }}"/>Wifi</label></li>
            <li><label><input class="mr-2" type="checkbox" name="services[parking]" @if($services->parking == 1) checked @endif value="{{ old("services[parking]", $services->parking) }}"/>Parcheggio</label></li>
            <li><label><input class="mr-2" type="checkbox" name="services[pool]" @if($services->pool == 1) checked @endif value="{{ old("services[pool]", $services->pool) }}"/>Piscina</label></li>
            <li><label><input class="mr-2" type="checkbox" name="services[concierge]" @if($services->concierge == 1) checked @endif value="{{ old("services[concierge]", $services->concierge) }}"/>Portineria</label></li>
            <li><label><input class="mr-2" type="checkbox" name="services[sauna]" @if($services->sauna == 1) checked @endif value="{{ old("services[sauna]", $services->sauna) }}"/>Sauna</label></li>
            <li><label><input class="mr-2" type="checkbox" name="services[sea_view]" @if($services->sea_view == 1) checked @endif value="{{ old("services[sea_view]", $services->sea_view) }}"/>Vista mare</label></li>
          </ul>
        </div>

        <div class="form-group">
          <label>LAT (TEST)</label>
          <input id="lat" type="text" name="lat" value="{{ old("lat", $flat->lat) }}" placeholder="Inserisci Latitudine">

          @error('lat')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>LON (TEST)</label>
          <input id="long" type="text" name="lon" value="{{ old("lon", $flat->lon) }}" placeholder="Inserisci Longitudine">

          @error('lon')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
        </div>

        <div class="form-group">
          <label>Carica l'immagine</label>
          <input type="file" class="form-control-file" name="image" value="{{ old("image", $flat->image) }}">
          @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifica appartamento</button>
      </form>
    @else
      <h1 class="text-danger">Non puoi modificare questo appartamento!</h1>
    @endif

  </div>
@endsection
