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
  {{-- contenuto centrale della pagina per la ricerca di un appartamento --}}
  <div class="ricerca">
    <h3>Ricerca un appartamento</h3>

    <div class="box_ricerca">
      <div class="input_ricerca">

        <form method="get" enctype="multipart/form-data" action="{{ route('search') }}">
          @csrf
          <div class="form-group">
            <input type="text"  id = "ricerca_lat" placeholder="Inserisci la latitudine" name="lat" value="">
          </div>
          <div class="form-group">
            <input type="text"  id = "ricerca_long" placeholder="Inserisci la longitude" name="lon" value="">
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
  @for ($i = 0; $i < 8; $i++)
    <div class="box_appartamento">
      <div class="info_appartamento">
        <h3>Titolo</h3>
        <a href="#"> <img src="" alt="immagine appartamento"> </a>
        <p>Luogo</p>
        <small>Prezzo</small>
      </div>
    </div>
  @endfor
@endsection
{{-- Fine sezione 2 --}}
