@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
            {{-- dall'indirizzo alle Coordinate --}}
            <div class="card">
                <div class="card-header">From address to Coordinates</div>

                <div class="card-body">
                      {{-- input e selectbox --}}
                    <input id="address" type="text" name="address" value="" placeholder="Inserisci Indirizzo">
                    <input id="long" type="text" name="long" value="" placeholder="Inserisci Longitudine">
                    <input id="lat" type="text" name="lat" value="" placeholder="Inserisci Latitudine">
                    <button id="geolocate_button" type="button" name="button">Daje</button>
                    <div id="risposta">
                      <select class="selectaddress hidden" name="">
                        <option value="Seleziona l'indirrizzo corretto">Seleziona Indirizzo</option>


                      </select>

                    </div>
                </div>
            </div>
            {{-- fine dall'indirizzo alle coordinate --}}
            {{-- reverse geocoding, da coordinate a inririzzo --}}
            <div class="card">
                <div class="card-header">From address to Coordinates</div>

                <div class="card-body">
                      {{-- input e selectbox --}}

                    <input id="rev-long" type="text" name="long" value="" placeholder="Inserisci Longitudine">
                    <input id="rev-lat" type="text" name="lat" value="" placeholder="Inserisci Latitudine">
                    <button id="rev-geolocate_button" type="button" name="button">Daje</button>
                    <div id="rev-risposta">
                      <p> Il tuo indirizzo è:</p>
                      <p id="rev-risposta-txt"></p>

                    </div>
                </div>
            </div>
            {{-- fine dall'indirizzo alle coordinate --}}
            {{-- mappa da indirizzo --}}
            <div class="card">
                <div class="card-header">From address to map</div>
                <button id="getmap" type="button" name="button">Get Map</button>

                <div class="card-body">
                      {{-- input e selectbox --}}

                    <div id="map-risposta"></div>
                </div>
            </div>
            {{-- fine dall'indirizzo alle coordinate --}}
        </div>
    </div>
</div>
@endsection
