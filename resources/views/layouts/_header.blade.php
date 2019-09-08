<header>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('images/logo_3.png')}}" alt="logo bool bnb"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        @guest
          <ul class="navbar-nav ml-auto">
            <li class="nav-item p-2 mr-3">
              <a href="{{ route('register') }}">Iscriviti</a>
            </li>
            <li class="nav-item p-2 mr-3">
              <a href="{{ route('login') }}" class="button">Accedi</a>
            </li>
          </ul>
        @else

          @php
            $currentUserFlats = DB::table('users')
                    ->join('flats', 'users.id', '=', 'flats.user_id')
                    ->where('users.id', Auth::user()->id)
                    ->get();
          @endphp

          @if ($currentUserFlats->isEmpty())
            <ul class="navbar-nav mr-auto">
              <li class="nav-item ml-5">
                <a href="{{ route('flats.create') }}">Aggiungi un appartamento</a>
              </li>
            </ul>
          @else
            <ul class="navbar-nav mr-auto">
              <li class="nav-item ml-5">
                <a href="{{ route('flats.create') }}">Aggiungi un appartamento</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item mr-5">
                <a href="#">Sponsorizza</a>
              </li>
              <li class="nav-item mr-5">
                <a href="{{ route('statistic') }}">Statistiche</a>
              </li>
              <li class="nav-item mr-5">
                <a href="#">Messaggi</a>
              </li>
              <li class="nav-item mr-5">
                <a href="{{ route('flats.index') }}">I miei appartamenti</a>
              </li>
            </ul>
          @endif

          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
            </li>
          </ul>
        @endguest

    </div>
  </nav>
</header>
