<header>
  <div class="header_content">
    <div class="logo_container">
      <a href="{{ route('home')}}"><img src="{{asset('images/logo_3.png')}}" alt="logo bool bnb"></a>

    </div>
    <nav>
      @guest
        <a href="{{ route('register') }}">Iscriviti</a>
        <a href="{{ route('login') }}" class="button">Accedi</a>
      @else
        <a href="#">Aggiungi un appartamento</a>
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
      @endguest




    </nav>
  </div>
</header>
