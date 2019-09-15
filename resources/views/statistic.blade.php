@extends('index')

@section('title')
  Statistiche appartamenti
@endsection

@section('content')

  @if (Auth::user()->id == $flat->user_id)
  <div class="container container-statistic mt-10">
    <h1 class="mb-5">Statistiche appartamento <span class="view-title">{{ $flat->title }}</span></h1>
    <div class="row text-center mb-5">
      <div class="col-sm-12 col-lg-6 my-5">
        <h4 class="mb-4"><span class="view-title">Visualizzazioni</span> uniche totali</h4>
        <h5><span class="highlight">{{ $totalUniqueViews }}</span></h5>
      </div>
      <div class="col-sm-12 col-lg-6 my-5">
        <h4 class="mb-4"><span class="view-title">Messaggi</span> totali ricevuti</h4>
        <h5><span class="highlight bg-blue">{{ $totalMessages }}</span></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="graph mb-4">
          {!! $flatViews->container() !!}
        </div>

      </div>
      <div class="col-sm-12 col-lg-6">
        <div class="graph mb-4">
        {!! $messageViews->container() !!}
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $flatViews->script() !!}
    {!! $messageViews->script() !!}
  </div>
  @else
    <h1 class="text-danger">Non puoi accedere a queste statistiche!</h1>
  @endif

@endsection
