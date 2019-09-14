@extends('index')

@section('title')
  Statistiche appartamenti
@endsection

@section('content')
<<<<<<< HEAD

  @if (Auth::user()->id == $flat->user_id)
=======
>>>>>>> rebase
  <div class="container mt-5">
    <h1 class="mb-5">Statistiche appartamento {{ $flat->title }}</h1>
    <div class="row text-center mb-5">
      <div class="col-sm-12 col-lg-6 my-5">
        <h4>Visualizzazioni uniche totali</h4>
<<<<<<< HEAD
        <h5>{{ $totalUniqueViews }}</h5>
      </div>
      <div class="col-sm-12 col-lg-6 my-5">
        <h4>Messaggi totali ricevuti</h4>
        <h5>{{ $totalMessages }}</h5>
=======
        <h5>{{ $totalViews }}</h5>
      </div>
      <div class="col-sm-12 col-lg-6 my-5">
        <h4>Messaggi totali ricevuti</h4>
        {{-- <h5>{{ $totalMessages }}</h5> --}}
>>>>>>> rebase
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
<<<<<<< HEAD
  @else
    <h1 class="text-danger">Non puoi accedere a queste statistiche!</h1>
  @endif

=======
>>>>>>> rebase
@endsection
