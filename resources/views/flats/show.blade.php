@extends('index')

@section('title')
  Dettagli appartamento {{ $flat->title }}
@endsection

@section('content')

<div class="container mt-10">
  <div class="row mt-5">
    <div class="col-12">
      <h1 class="float-left mb-5">Dettagli appartamento: <span class="text-primary">{{ $flat->title }}</span></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      @if ($flat->image)
        <img class="img-fluid w-100" src="{{ asset('storage/'.$flat->image) }}" alt="immagine appartamento">
      @else
        <a href="#"> <img src="https://dummyimage.com/500x300/fff/aaa" alt="immagine appartamento"> </a>
      @endif
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-6">

      <h3>Descrizione</h3>
      <p>{{ $flat->description }}</p>
    </div>
    <div class="col-3 text-right">
      <ul class="list-group list-unstyled">
        <li><h3>Caratteristiche</h3></li>
        <li>Stanze: {{ $flat->room }}</li>
        <li>Letti: {{ $flat->bed }}</li>
        <li>Bagni: {{ $flat->bathroom }}</li>
        <li>MQ: {{ $flat->sm }}</li>
        <li>Indirizzo: {{ $flat->address }}</li>
      </ul>
    </div>
    <div class="col-3 text-right">
      <ul class="list-group list-unstyled">
        <li><h3>Servizi</h3></li>
        <li>Wifi: @if($services->wifi == 1) si @else no @endif</li>
        <li>Parcheggio: @if($services->parking == 1) si @else no @endif</li>
        <li>Piscina: @if($services->pool == 1) si @else no @endif</li>
        <li>Portineria: @if($services->concierge == 1) si @else no @endif</li>
        <li>Sauna: @if($services->sauna == 1) si @else no @endif</li>
        <li>Vista mare: @if($services->sea_view == 1) si @else no @endif</li>
      </ul>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12">
      <input id="lat" type="text" name="lat" value="{{$flat->lat}}">
      <input id="long" type="text" name="lon" value="{{$flat->lon}}">
      <input id="address" type="text" name="address" value="{{$flat->address}}" >
      <div id="singleflatmap" class="singleflatmap"></div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12">
      <h2>Invia un messaggio al proprietario</h2>
      <form method="post" enctype="multipart/form-data" action="{{ '/sendmessage' }}">
        @csrf
        <input type="hidden" name="flat_id" value="{{ $flat->id }}">
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" placeholder="Inserisci l'email" name="sender" value="{{ Auth::user() ? Auth::user()->email : old("sender") }}">
          @error('sender')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Oggetto</label>
          <input type="text" class="form-control" placeholder="Inserisci l'oggetto del messaggio" name="subject" value="{{ old("subject") }}">
          @error('subject')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label>Messaggio</label>
          <textarea class="form-control" placeholder="Inserisci il testo del messaggio" name="message" rows="5"></textarea>
          @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target = "#sent_msg">Invia il messaggio</button>



        {{-- <div class="modal fade" id="sent_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Messaggio inviato con successo!</h5>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target = "sent_msg">Ok</button>
              </div>
            </div>
          </div>
        </div> --}}

      </form>
    </div>
  </div>


</div>

@endsection
