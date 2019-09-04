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

        @forelse ($flat as $flatPromoted)
          <div class="box_appartamento">
            <div class="info_appartamento">
          <h3>{{ $flatPromoted->title }}</h3>
          @if ($flatPromoted->image)
            <img class="img-fluid" src="{{ asset('storage/'.$flatPromoted->image) }}" alt="immagine appartamento">
          @else
            <a href="#"> <img src="https://dummyimage.com/200x200/fff/aaa" alt="immagine appartamento"> </a>
          @endif
          <p>{{ $flatPromoted->address }}</p>
          <p><small>{{ $flatPromoted->price . '€' }}</small></p>
          <a class="btn btn-primary" href="{{ route('flats.show', $flatPromoted->id) }}">Visualizza appartamento</a>
        </div>
      </div>
        @empty
          <h1 class="text-warning">Non sono presenti appartamenti</h1>
        @endforelse

@endsection


{{-- Fine sezione 2 --}}
