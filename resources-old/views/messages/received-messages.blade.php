@extends('index')
{{-- @extends('index') --}}

@section('title')
  I miei messaggi
@endsection

@section('content')

<div class="container mt-10">
  <h1 class="float-left mb-5">I miei messaggi</h1>
  <table class="table table-striped text-center">
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

      //filtra il db e prende i messaggi dell'utente loggato
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
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{!! $message->id !!}">Cancella</button>

            <div class="modal fade" id="deleteModal{!! $message->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Vuoi davvero cancellare il messaggio?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-footer">
                    <form id="deleteForm{!! $message->id !!}" action="{{ route('messages.destroy', $message->id) }}" method="post">
                      @method("DELETE")
                      @csrf
                      <button type="submit" class="btn btn-danger" form="deleteForm{!! $message->id !!}" type="submit" >Si</button>
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
        <td colspan="6">Non sono presenti messaggi</td>
      </tr>
    @endforelse

  </tbody>
</table>


</div>

@endsection
