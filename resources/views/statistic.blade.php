@extends('index')

@section('title')
  Statistiche appartamento
@endsection

@section('content')
  <div class="container mt-5">
    <h2 class="mb-3">Appartamento 1</h2>
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
