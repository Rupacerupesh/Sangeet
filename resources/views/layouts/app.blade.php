<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nav.css') }}">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                                            <button onclick="Functionhideplayer()" class="btnPrev">show/hide player</button>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Sangeet') }}
                    </a>
                </div>



                <div class="collapse navbar-collapse" id="navbar">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
					
				</li>
				
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                       
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
						 <li class="active"><a href="{{ route('musics.recommended', ['uid' => Auth::user()->id ] ) }}">My Music<span class="sr-only">(current)</span></a></li
                         >
                         <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">My Playlist</a>
								<ul class="dropdown-menu">
                                @forelse($playlists as $playlist)
										@if(Auth::user()->id == $playlist->user_id)
										<li><a href="{{ route('musics.playlist', ['id' => $playlist->id ] ) }}">{{$playlist->Name}}</a></li>
                                          @endif
								@empty
                                <li>no playlist</li>
                                @endforelse
                                          <li><a href="{{ route('playlist.create', [ 'uid' => Auth::user()->id ]) }}" >Create New Playlist </a></li>
									
								</ul>
							</li>
                         <li class="divider"></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">My Profile</a></li>
                                    <li><a href="#">My Playlist</a></li>
                                    
                                    <li class="divider"></li>
                                    <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
    			<form action="{{ route('musics.newsearch') }}" class="navbar-form navbar-right search-form" role="search">
                <input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Search"></div>
    			</form>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
<!-- NEW NAV -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script>
		$( function() {
    $( "#searchItem" ).autocomplete({
      source: '{{ route('musics.newsearch') }}'
    });
  } );
	</script>
</body>
</html>
