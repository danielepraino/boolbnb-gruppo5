@extends('index')

@section('title')
  BoolBnB
@endsection

@section('img_slider')
  {{-- img su cui effettuare uno slider automatico tramite le img inserite nel database --}}
    <img src="https://www.tgcom24.mediaset.it/binary/47.$plit/C_4_foto_1288622_image.JPG" alt="">
@endsection

@section('home')
  home
@endsection

{{-- Sezione 1: contenuto ricerca --}}
@section('content')
  <img src="images\hotels-in-heaven-four-seasons-resort-bali-outdoor-pool-oceanview-luxury.jpg" class="img-fluid"  alt="">
  {{-- contenuto centrale della pagina per la ricerca di un appartamento --}}
  <div class="ricerca">
    <h3>Ricerca un appartamento</h3>

    <div class="box_ricerca">
      <div class="input_ricerca">
        <form method="post" enctype="multipart/form-data" action="{{ route('search') }}">
          @csrf
          <input id="address" type="text" name="address" value="" placeholder="Inserisci Indirizzo">
          <button id="geolocate_button" type="button" name="button">Daje</button>

          <div id="risposta">
            <select class="selectaddress hidden" name="">
              <option value="Seleziona l'indirrizzo corretto">Seleziona Indirizzo</option>
            </select>
          </div>

          <div class="form-group">
            <input type="hidden"  id = "ricerca_lat" placeholder="Inserisci la latitudine" name="lat" value="">
          </div>
          <div class="form-group">
            <input type="hidden"  id = "ricerca_long" placeholder="Inserisci la longitude" name="lon" value="">
          </div>
          <div class="form-group">
            <input type="hidden"  id = "ricerca_raggio" placeholder="Inserisci la longitude" name="radius" value="20">
          </div>
          <button type="submit" id = "search_button" > <i class="fas fa-search"></i> </button>
        </form>
      </div>
    </div>
  </div>
@endsection
{{-- Fine sezione 1 --}}


{{-- Sezione 2: contenuto appartamenti in evidenza (da valutare se farlo tramite ajax+handlebars) --}}
@section('appartamenti_in_evidenza')
  {{-- Contenuto appartamenti in evidenza --}}
  <div class="container mt-5 ">
    <div class="row">
      @foreach ($flat as $flatPromoted)
      <div class="col-sm-12 col-md-4 col-lg-3">
        {{-- <h3>{{ $flatPromoted->title }}</h3> --}}
        @if ($flatPromoted->image)
          <img class="img-fluid" src="{{ asset('storage/'.$flatPromoted->image) }}" alt="immagine appartamento">
        @else
          <a href="{{ route('flats.show', $flatPromoted->id) }}"> <img src="https://dummyimage.com/255x255/fff/aaa" alt="immagine appartamento"> </a>
        @endif
        <div class="dettagli">
          <p><i class="fas fa-map-marked"></i> {{ $flatPromoted->address }}</p>
          <div class="info_flat">
            <small> <i class="fas fa-bed"></i> {{ $flatPromoted->bed}}</small>
            <small> <i class="fas fa-building"></i> {{ $flatPromoted->room}}</small>
            <small id = "flat_price"> <i class="fas fa-euro-sign" ></i> <span>{{ $flatPromoted->price}}</span>/notte</small>
          </div>
        </div>
        <a class="btn btn-primary mb-5" href="{{ route('flats.show', $flatPromoted->id) }}">Visualizza appartamento</a>
      </div>
      @endforeach
    </div>
  </div>
  <div class="container text-center">
    <div class="row">
      <div class="col-12">
        {{ $flat->links() }}
      </div>
    </div>
  </div>
@endsection


{{-- Fine sezione 2 --}}
