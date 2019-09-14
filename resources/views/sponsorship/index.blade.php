@extends('index')

@section('title')
<<<<<<< HEAD
  Sommario sponsorizzazioni
=======
  Promozioni appartamenti
>>>>>>> rebase
@endsection

@section('content')

<<<<<<< HEAD
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

=======
  <div class="container mt-5">
    <div class="row">
      <div class="col">
      <h1>Sommario sponsorizzazioni Attive</h1>


        <table class="table">
          <thead>
            <tr>
              <th scope="col">Apt id</th>
              <th scope="col">title</th>

              <th scope="col">Duration</th>
              <th scope="col">price</th>
              <th scope="col">Created At</th>
              <th scope="col">Expires</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($sponsoreds as $sponsoredItem)
            <tr>
              <td scope="row">{{ $sponsoredItem->id }}</td>
              <td>{{ $sponsoredItem->title }}</td>
              <td>{{ $sponsoredItem->duration }}</td>
              <td>{{ $sponsoredItem->price }} </td>
              <td>{{ $sponsoredItem->created_at }}</td>
              <td>{{ $sponsoredItem->sponsorships_expires }}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
        <br>
        <hr>
        <br>
        <h1>Sommario sponsorizzazioni scadute</h1>
          @php
          use Carbon\Carbon;
          $expireds = DB::table('flats')
                ->join('sponsorships', 'flats.id', '=', 'sponsorships.flat_id')
                ->whereDate('sponsorships_expires', '<', Carbon::now())
                ->get();
          @endphp

          <table class="table">
            <thead>
              <tr>
                <th scope="col">Apt id</th>
                <th scope="col">title</th>

                <th scope="col">Duration</th>
                <th scope="col">price</th>
                <th scope="col">Created At</th>
                <th scope="col">Expires</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($expireds as $expired)
              <tr>
                <td scope="row">{{ $expired->id }}</td>
                <td>{{ $expired->title }}</td>
                <td>{{ $expired->duration }}</td>
                <td>{{ $expired->price }} </td>
                <td>{{ $expired->created_at }}</td>
                <td>{{ $expired->sponsorships_expires }}</td>
              </tr>
                @endforeach
            </tbody>
          </table>


      </div>
    </div>
  </div>
<<<<<<< HEAD
  
>>>>>>> rebase
=======

>>>>>>> sponsorship page
@endsection
