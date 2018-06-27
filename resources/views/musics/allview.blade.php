@section('mselect')
<div class="panel-body">

						<div class="row">
													<div align= "left" class="col-md-12">

								<li class="dropdown dropdown-submenu"><a href="#"class="btn btn-default" data-toggle="dropdown">Select Genre</a>
								<ul class="dropdown-menu" align="right" class="col-md-12">
								
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Rock'] ) }}">Rock</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Pop'] ) }}">Pop</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Bhajan'] ) }}">Bhajan</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Alternative'] ) }}">Alternative</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Dance'] ) }}">Dance</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'RnB'] ) }}">RnB</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'HipHop'] ) }}">HipHop</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Country'] ) }}">Country</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Classic'] ) }}">Classic</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Instrumental'] ) }}">Instrumental</a></li>
										<li><a href="{{ route('musics.ViewByGenre', ['genre' => 'Romance'] ) }}">Romance</a></li>
								</ul>
							</div>
							
							<div align= "center" class="col-md-12">
								<h3 align="center">Mood Selection</h3>
								<a href="{{ route('musics.mood', ['tag' => 'Sad' ]) }}" class="btn btn-default">Sad</a>
								<a href="{{ route('musics.mood', ['tag' => 'Happy']) }}" class="btn btn-default">Happy</a>
								<a href="{{ route('musics.mood', ['tag' => 'Neutral']) }}" class="btn btn-default">Neutral</a>
								<a href="{{ route('musics.mood', ['tag' => 'Romance']) }}" class="btn btn-default">Romance</a>
							</div>
						</div>
</div>
@endsection


<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Song Name</th>
				<th>Artist</th>
				<th>Album</th>
				<th>Language</th>
				<th>Actions</th>
				<th>Playlist</th>
			</tr>
		</thead>
		<tbody>
@forelse($musics as $music)
                <tr>
                    <td><a href="{{ route('musics.ViewSong', ['id' => $music->id]) }}">{{ $music->Song_name }}
                            </a></td>
                    <td><a href="{{ route('musics.ViewByArtist', ['artist_id' => $music->artist_id]) }}">   
                            @foreach($artists as $artist)
                                  @if($artist['id']==$music['artist_id'])
                                    {{ $artist->name}}
                                  @endif
                              @endforeach</a></td>
                    <td><a href="{{ route('musics.ViewByAlbum', ['album_id' => $music->album_id]) }}">

                                    @foreach($albums as $album)
                                  @if($album['id']==$music['album_id'])
                                    {{ $album->title}}
                                  @endif
                              @endforeach</a></td>
              
                <td><a href="{{ route('musics.ViewByLanguage', ['language' => $music->language]) }}">{{$music->language}}</a>
                </td>
                
					<td>
						@if(Auth::user())
						<a href="{{ route('musics.newshow', ['id' => $music->id , 'uid' => Auth::user()->id ,'gen' => $music->genre  ] ) }}" class="btn btn-sm btn-info">Show user</a>
						@else
						<a href="{{ route('musics.show', ['id' => $music->id]) }}" class="btn btn-sm btn-info">Show</a>
						@endif
						@if(Auth::user())
						@if(Auth::user()->role==1)					
						<a href="{{ route('musics.edit', ['id' => $music->id]) }}" class="btn btn-sm btn-info">Edit</a>
						<form style="display: inline-block;" action="{{ 		route('musics.destroy', ['id' => $music->id]) }}" method="post">
						<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete?';)">Delete</button>
						<input type="hidden" name="_method" value="DELETE">
						{{ csrf_field() }}
						</form>
						@endif
						@endif
					</td>
					<td>
						@if(Auth::user())
						<form action="{{ route('playlistsong.store') }}"  method="post">
							<select id="playlist_id" name="playlist_id" >
										@foreach($playlists as $playlist)
										@if(Auth::user()->id == $playlist->user_id)
										<option value="{{$playlist->id}}">{{$playlist->Name}}</option>
										  @endif
										  @endforeach
							</select>
							<div style="display: none" class="form-group">
								<label for="song_id">Song id: </label>
								<input type="text" class="form-control" id="song_id" name="song_id" value="{{ $music->id }}">
							</div>
							
							<button class="btn btn-sm btn-info" type="submit">Add to playlist</button>
							{{ csrf_field() }}
						</form>
							
						@endif
					</td>
				</tr>
				@empty
					<tr>
						<td colspan="3">No records found.</td>
					</tr>
			@endforelse
		</tbody>
	</table>
</div>
