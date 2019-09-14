@extends('index')

@section('title')
  Sommario sponsorizzazioni
@endsection

@section('content')

  <div class="container mt-10">
    <h1 class="float-left mb-5">Sommario sponsorizzazioni</h1>
    <table class="table table-striped text-center table-styled">
    <thead>
      <tr>
        <th scope="col">id <i class="fas fa-info"></i></th>
        <th scope="col">Appartamento <i class="fas fa-building"></th>
        <th scope="col">Durata ore <i class="fas fa-clock"></i></th>
        <th scope="col">Acquistata il <i class="fas fa-credit-card"></i></th>
        <th scope="col">Scade il <i class="fas fa-exclamation-triangle"></i></th>
      </tr>
    </thead>
    <tbody>
      @php
        $currentUserSponsorships = DB::table('sponsorships')
                ->join('flats', 'sponsorships.flat_id', '=', 'flats.id')
                ->where('flats.user_id', Auth::user()->id)
                ->get();
      @endphp

      @forelse ($currentUserSponsorships as $sponsorship)
          <tr>
            <th>{{ $sponsorship->id }}</th>
            <td>{{ $sponsorship->title }}</td>
            <td>{{ $sponsorship->duration }}</td>
            <td>{{ $sponsorship->created_at }}</td>
            <td>{{ $sponsorship->updated_at }}</td>
          </tr>

      @empty
        <tr>
          <td colspan="6">Al momento non ci sono promozioni attive</td>
        </tr>
      @endforelse

    </tbody>
  </table>


  </div>

@endsection
