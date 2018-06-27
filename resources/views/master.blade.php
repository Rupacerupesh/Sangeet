<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
		<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
	<style type="text/css">
	audio::-internal-media-controls-download-button {
    display:none;
	}

	audio::-webkit-media-controls-enclosure {
	    overflow:hidden;
	}

	audio::-webkit-media-controls-panel {
	    width: calc(100% + 30px); /* Adjust as needed */
	}
	</style>
</head>
<body>

	<div class="container" align="center">
		@if(Auth::user())
		<h3>Hello! {{Auth::user()->name}}. What would you like to hear today ?</h3> 
		@else
		<h3>Hello Guest!,<a href="{{ route('register') }}">Register</a> to be updated with our latest updates.</h3>
		@endif 	
		<a href="{{ route('musics.index') }}" class="btn btn-default">View All Songs</a>
		<a href="{{ route('welcome') }}" class="btn btn-default">Home</a>
		@if(Auth::user())
		@if(Auth::user()->role == 1) 
		<a href="{{ route('musics.create') }}" class="btn btn-default">Add Songs</a>
		<a href="{{ route('albums.create') }}" class="btn btn-default">Add Album</a>
		<a href="{{ route('artists.create') }}" class="btn btn-default">Add Artist</a>

		@endif
		@endif

		<div class="row"> 
						@if(session()->has('errors'))
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						@if(session()->has('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						<div class="panel-body">
						@yield('mselect')
						<div class="row">
							<div class="col-md-12">
							
								@yield('mastercontent')
							
						</div>
		</div>			
	</div>
	</div>
	</div>

	<div id="playerDIV">
<div class="pcontainer">
		<div class="column center">....</div>
		    <div class="column add-bottom">
 				<div id="mainwrap">

				    	   
			            <div id="nowPlay">

			                <span class="left" id="npAction">Paused...</span>
			                <span class="right" id="npTitle"></span>
			            </div>
			            <div id="audiowrap">
			                <div id="audio0">
			                    <audio preload id="audio1" controls="controls">Your browser does not support HTML5 Audio!</audio>
			                </div>
			                
						<button onclick="Functionhideplaylist()" class="btnPrev">show/hide playlist</button>

			                <div id="tracks">
			                    <a id="btnPrev">&laquo;</a>
			                    <a id="btnNext">&raquo;</a>
			                </div>
			            </div>

							<div id="playlistDIV">
							            <div id="plwrap">
							                <ul id="plList">
							                </ul>
							            </div>
							 </div>			        	
			    </div>
			</div>
			</div>

</div>


 <script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
 @yield('script')
 <script type="text/javascript" src="{{ URL::asset('js/html5audio.js') }}"></script>
 	
 
</body>
</html>