@extends('index')

@section('title')
  Dettagli appartamento {{ $flat->title }}
@endsection

@section('content')

<div class="container mt-10">
  <div class="row">
    <div class="col-12">
      <img class="img-fluid" src="{{ asset('storage/'.$flat->image) }}" alt="immagine appartamento">
      <h1 class="float-left mb-5">Dettagli appartamento {{ $flat->title }}</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <p>{{ $flat->description }}</p>
    </div>
    <div class="col-6">
      <ul>
        <li>Stanze: {{ $flat->room }}</li>
        <li>Letti: {{ $flat->bed }}</li>
        <li>Bagni: {{ $flat->bathroom }}</li>
        <li>MQ: {{ $flat->sm }}</li>
        <li>Indirizzo: {{ $flat->address }}</li>
      </ul>
    </div>
  </div>


</div>

@endsection
