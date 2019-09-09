@extends('index')

@section('title')
Messaggio da {{ $message->sender }}
@endsection

@section('content')

<div class="container col-12">

  <div class="card">
    <div class="card-header">
      Messaggio ricevuto da {{ $message->sender}}
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>Soggetto: {{ $message->subject }}</p>
        <footer class="blockquote-footer">{{$message->message}}</footer>
      </blockquote>
    </div>
  </div>

</div>


@endsection
