@extends('index')
{{-- @extends('index') --}}

@section('title')
  I miei appartamenti
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
    </tr>
  </thead>
  <tbody>
    @php
      //filtra il db e prende gli appartamenti dell'utente loggato
      $messages = DB::table('messages')
              ->join('flats', 'flats.id', '=', 'messages.flat_id')
              ->join('users', 'users.id', '=', 'flats.user_id')
              ->where('users.id', Auth::user()->id)
              ->get();
                dd($messages)
      // $currentUserFlats = DB::table('users')
      //         ->join('flats', 'users.id', '=', 'flats.user_id')
      //         ->where('users.id', Auth::user()->id)
      //         ->get();
      //         dd($currentUserFlats);
    @endphp



    {{-- @forelse ($currentUserFlats as $flat)
        <tr>
          <th>{{ $message->id }}</th>
          <td>{{ $flat->title }}</td>
          <td>{{ $flat->description }}</td>
          <td>{{ $flat->room }}</td>
          <td>{{ $flat->bed }}</td>
          <td>{{ $flat->bathroom }}</td>
          <td>{{ $flat->sm }}</td>
          <td>{{ $flat->address }}</td>
          <td><img class="flat-preview" src="{{ asset('storage/'.$flat->image) }}" alt="immagine appartamento"></td>
          <td>
            <a class="btn btn-secondary" href="{{ route('flats.show', $flat->id) }}">Visualizza</a>
            <a class="btn btn-warning" href="{{ route('flats.edit', $flat->id) }}">Modifica</a>
            <form action="{{ route('flats.destroy', $flat->id) }}" method="post">
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
    @endforelse --}}

  </tbody>
</table>


</div>

@endsection
