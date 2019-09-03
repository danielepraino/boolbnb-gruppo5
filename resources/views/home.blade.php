@extends('index')

@section('title')
  BoolBnB
@endsection

@section('img_slider')
  {{-- img su cui effettuare uno slider automatico tramite le img inserite nel database --}}
    <img src="https://www.tgcom24.mediaset.it/binary/47.$plit/C_4_foto_1288622_image.JPG" alt="">
@endsection

{{-- Sezione 1: contenuto ricerca --}}
@section('content')
  {{-- contenuto centrale della pagina per la ricerca di un appartamento --}}
  <div class="ricerca">
    <h3>Ricerca un appartamento</h3>

    <div class="box_ricerca">
      <div class="input_ricerca">
        <input type="text"  id = "ricerca_località" placeholder="Inserisci la località" name="" value="">
        <input type="text"  id = "ricerca_appartamento" placeholder="Ricerca tipo appartamento" name="" value="">
        <button type="button" name="button"> <i class="fas fa-search"></i> </button>
      </div>
    </div>
  </div>
@endsection
{{-- Fine sezione 1 --}}


{{-- Sezione 2: contenuto appartamenti in evidenza (da valutare se farlo tramite ajax+handlebars) --}}
@section('appartamenti_in_evidenza')
  @for ($i = 0; $i < 8; $i++)
    <div class="box_appartamento {{ $i }}">
      <div class="info_appartamento">
        <img src="" alt="immagine appartamento">
        <h3>Titolo</h3>
        <p>Descrizione</p>
        <small>Prezzo</small>
      </div>
    </div>
  @endfor
@endsection
{{-- Fine sezione 2 --}}
