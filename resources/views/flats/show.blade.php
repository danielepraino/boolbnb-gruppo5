@extends('index')

@section('title')
  Dettagli appartamento {{ $flat->title }}
@endsection

@section('content')

<div class="container mt-10">
  <div class="row">
    <div class="col-12">
      @if ($flat->image)
        <img class="img-fluid" src="{{ asset('storage/'.$flat->image) }}" alt="immagine appartamento">
      @else
        <a href="#"> <img src="https://dummyimage.com/500x300/fff/aaa" alt="immagine appartamento"> </a>
      @endif
      <h1 class="float-left mb-5">Dettagli appartamento: <span class="text-primary">{{ $flat->title }}</span></h1>
    </div>
  </div>
  <div class="row">
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
    <input id="lat" type="text" name="lat" value="{{$flat->lat}}">
    <input id="long" type="text" name="lon" value="{{$flat->lon}}">
    <input id="address" type="text" name="address" value="{{$flat->address}}" >
    <div id="singleflatmap" class="singleflatmap"></div>
  </div>


</div>

@endsection
