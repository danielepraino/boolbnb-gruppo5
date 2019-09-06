@extends('index')

@section('title')
  Aggiungi un nuovo appartamento
@endsection

@section('content')
  <div class="container mt-10 mb-5">
    <h1>Aggiungi un nuovo appartamento</h1>

    <form method="post" enctype="multipart/form-data" action="{{ route('flats.store') }}">
      @csrf
      <div class="form-group">
        <label>Titolo</label>
        <input type="text" class="form-control" placeholder="Inserisci il titolo" name="title" value="{{ old("title") }}">
        @error('title')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Descrizione</label>
        <textarea class="form-control" placeholder="Inserisci la descrizione dell'appartamento" name="description" rows="5"></textarea>
        @error('description')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Stanze</label>
        <input type="text" class="form-control" placeholder="Inserisci il numero di stanze" name="room" value="{{ old("room") }}">
        @error('room')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Letti</label>
        <input type="text" class="form-control" placeholder="Inserisci il numero di letti" name="bed" value="{{ old("bed") }}">
        @error('bed')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Bagni</label>
        <input type="text" class="form-control" placeholder="Inserisci il numero di bagni" name="bathroom" value="{{ old("bathroom") }}">
        @error('bathroom')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Metri quadri</label>
        <input type="text" class="form-control" placeholder="Inserisci i metri quadri" name="sm" value="{{ old("sm") }}">
        @error('sm')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Indirizzo</label>
        <input id="address" type="text" name="address" value="" placeholder="Inserisci Indirizzo">
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
        <label>LAT (TEST)</label>
        <input id="lat" type="text" name="lat" value="" placeholder="Inserisci Latitudine">

        {{-- <input type="text" class="form-control" placeholder="Latitudine (TEST)" name="lat" value="{{ old("lat") }}"> --}}
        @error('lat')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>LON (TEST)</label>
        <input id="long" type="text" name="lon" value="" placeholder="Inserisci Longitudine">

        {{-- <input type="text" class="form-control" placeholder="Longitudine (TEST)" name="lon" value="{{ old("lon") }}"> --}}
        @error('lon')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div id="map-risposta" class="map-risposta hidden">

      </div>
      <div class="form-group">
        <label>Prezzo di affitto per notte</label>
        <input type="text" class="form-control" placeholder="Inserisci il prezzo di affitto per notte" name="price" value="{{ old("price") }}">
        @error('price')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Vuoi che l'annuncio sia visibile da subito?</label>
        <input type="hidden" class="form-control"  name="visible" value="0" />
        <input type="checkbox" class="form-control" checked  name="visible" value="1" />
      </div>

      <div class="form-group">
        <ul>
          <li><label><input type="checkbox" name="services[]" value="0"/>Wifi</label></li>
          <li><label><input type="checkbox" name="services[]" value="0"/>Parcheggio</label></li>
        </ul>
      </div>

      <div class="form-group">
        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
      </div>

      <div class="form-group">
        <label>Carica l'immagine</label>
        <input type="file" class="form-control-file" name="image" value="{{ old("image") }}">
        @error('image')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Aggiungi nuovo</button>
    </form>

  </div>
@endsection
