<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{Route::currentRouteName()=='home'?'active':''}}">
        <a class="nav-link" href="{{route('home')}}">Home | <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{(Route::currentRouteName()=='questioniers.index' || Route::currentRouteName()=='questioniers.create' || Route::currentRouteName()=='create-question')?'active':''}}">
        <a class="nav-link" href="{{route('questioniers.index')}}">Questioniers |</a>
      </li>
      <li class="nav-item {{Route::currentRouteName()=='results'?'active':''}}">
        <a class="nav-link" href="{{route('home')}}">Results</a>
      </li>
    </ul>
    @if (Route::has('login'))
    @auth
    <a class="this_a_links" href="#">Profile</a>
    <span style="margin-left: 2px;margin-right: 2px;"> | </span>
    <a class="this_a_links" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
    @else
    <a class="this_a_links" href="{{ route('login') }}">Login</a>
    <span style="margin-left: 2px;margin-right: 2px;"> | </span>
    @if (Route::has('register'))
    <a class="this_a_links" href="{{ route('register') }}">Register</a>
    @endif
    @endauth

    @endif
  </div>
</nav>
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>