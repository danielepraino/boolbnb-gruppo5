@extends('index')

@section('title')
  I miei appartamenti
@endsection

@section('content')

<div class="container container-flats-index mt-10">
  <h1 class="float-left mb-5">I miei appartamenti</h1>
  <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Titolo</th>
      <th scope="col">Descrizione</th>
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
    @php
      //filtra il db e prende gli appartamenti dell'utente loggato
      $currentUserFlats = DB::table('users')
              ->join('flats', 'users.id', '=', 'flats.user_id')
              ->where('users.id', Auth::user()->id)
              ->get();


    @endphp

    @forelse ($currentUserFlats as $flat)
        <tr>
          <th>{{ $flat->id }}</th>
          <td>{{ $flat->title }}</td>
          <td>{{ $flat->description }}</td>
          <td>{{ $flat->room }}</td>
          <td>{{ $flat->bed }}</td>
          <td>{{ $flat->bathroom }}</td>
          <td>{{ $flat->sm }}</td>
          <td>{{ $flat->address }}</td>
          <td><img class="flat-preview" src="{{ asset('storage/'.$flat->image) }}" alt="immagine appartamento"></td>
          <td>
            <a title="Visualizza" href="{{ route('flats.show', $flat->id) }}"><i class="fas fa-eye"></i></a>
            <a title="Modifica" href="{{ route('flats.edit', $flat->id) }}"><i class="fas fa-edit"></i></a>
            <a title="Sponsorizza" href="{{ route('sponsorship.create', 'flatId='.$flat->id) }}"><i class="fas fa-rocket"></i></a>
            <a title="Statistiche" href="{{ route('statistic', 'flatId='.$flat->id) }}"><i class="fas fa-chart-line"></i></a>
            <button type="button" title="Cancella" data-toggle="modal" data-target="#deleteApt{!! $flat->id !!}"><i class="fas fa-trash"></i></button>

            <div class="modal fade" id="deleteApt{!! $flat->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Vuoi davvero cancellare l'appartamento?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-footer">
                    <form id="deleteForm{!! $flat->id !!}" action="{{ route('flats.destroy', $flat->id) }}" method="post">
                      @method("DELETE")
                      @csrf
                      <button type="submit" class="btn btn-danger" form="deleteForm{!! $flat->id !!}" type="submit" >Si</button>
                    </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
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
