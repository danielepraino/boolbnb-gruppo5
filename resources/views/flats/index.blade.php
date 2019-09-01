@extends('index')

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
      <th scope="col">Titolo</th>
      <th scope="col">Stanze</th>
      <th scope="col">Letti</th>
      <th scope="col">Bagni</th>
      <th scope="col">MQ</th>
      <th scope="col">Indirizzo</th>
      <th scope="col">Immagine</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($flats as $flat)
        <tr>
          <th>{{ $flat->id }}</th>
          <td>{{ $flat->title }}</td>
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
    @endforelse

  </tbody>
</table>


</div>

@endsection
