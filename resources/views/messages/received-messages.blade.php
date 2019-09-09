@extends('index')
{{-- @extends('index') --}}

@section('title')
  I miei messaggi
@endsection

@section('content')

<div class="container mt-10">
  <h1 class="float-left mb-5">I miei appartamenti</h1>
  <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Mittente</th>
      <th scope="col">Soggetto</th>
      <th scope="col">Messaggio</th>
      <th scope="col">Appartamento</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @php

      //filtra il db e prende gli appartamenti dell'utente loggato
      $messages = DB::table('flats')
              ->join('messages', 'flats.id', '=', 'messages.flat_id')
              ->where('flats.user_id', Auth::user()->id)
              ->get();
    @endphp



    @forelse ($messages as $message)

        <tr>
          <th>{{ $message->id }}</th>
          <td>{{ $message->sender }}</td>
          <td>{{ $message->subject }}</td>
          <td>{{ $message->message }}</td>
          <td>{{ $message->flat_id }}</td>
          <td>
            <a class="btn btn-secondary" href="{{ route('messages.show', $message->id) }}">Visualizza</a>
            <form action="{{ route('messages.destroy', $message->id) }}" method="post">
              @method("DELETE")
              @csrf
              <input class="btn btn-danger" type="submit" name="" value="Cancella">
            </form>
          </td>
        </tr>

    @empty
      <tr>
        <td colspan="6">Non sono presenti appartamenti</td>
      </tr>
    @endforelse

  </tbody>
</table>


</div>

@endsection
