<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

<nav class="navbar navbar-expand-md navbar-dark bg-success" >
<div class="container" >
<a class="navbar-brand"  href="{{ url('/') }}">
    {{config('app.name','LeagueApp')}}
    </a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
 <!--    <li class="nav-item active">
        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
    </li>-->
    <li class="nav-item">
        <a class="nav-link" href="/players">Jucatori </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/games">Rezultate</a>
    </li>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/posts">Echipe</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/tables">Clasament</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="/bets">Pariuri</a>
            </li> --}}
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Autentificare') }}</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Inregistrare') }}</a></li>
        @else
      
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Adauga
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/posts/create">Echipa</a>
                  <a class="dropdown-item" href="/games/create">Meciuri</a>
                </div>
              </li>


            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }} <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>

</div>
</div>   
</nav>

