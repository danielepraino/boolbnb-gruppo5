@extends('index')

@section('title')
  Statistiche appartamenti
@endsection

@section('content')
  <div class="container mt-5">
    <h1 class="mb-5">Sommario statistiche appartamenti</h1>
    <div class="row text-center mb-5">
      <div class="col-sm-12 col-lg-6 my-5">
        <h4>Visualizzazioni uniche totali</h4>
        <h5>{{ $totalViews }}</h5>
      </div>
      <div class="col-sm-12 col-lg-6 my-5">
        <h4>Messaggi totali ricevuti</h4>
        <h5>{{ $totalMessages }}</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        {!! $flatViews->container() !!}
      </div>
      <div class="col-sm-12 col-lg-6">
        {!! $messageViews->container() !!}
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $flatViews->script() !!}
    {!! $messageViews->script() !!}
  </div>
@endsection
