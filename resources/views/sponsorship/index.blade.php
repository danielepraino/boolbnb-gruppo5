@extends('index')

@section('title')
SPONSORIZZAZIONI
@endsection

@section('content')


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
              <td scope="row">{{ $sponsoredItem->flat_id }}</td>
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
                ->where('flats.user_id', Auth::user()->id)
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

@endsection
