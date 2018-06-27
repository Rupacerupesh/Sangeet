@extends('master')
@extends('layouts.app')



@section('title','Recommended For You')

@section('content')

		@if(Auth::user())
		<h1 align="center">Good {{$greet}} {{Auth::user()->name}}.</h1>
        <h3 align="center">Here are some Songs recommendation for you.</h3>
        <h3 align="center">Based on your previous records.</h3>  
		@else
		<h3>Hello Guest!,<a href="{{ route('register') }}">Register</a> to be updated with our latest updates.</h3>
		@endif 	
			
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
						<a href="{{ route('musics.edit', ['id' => $music->id]) }}" class="btn btn-sm btn-info">Edit</a>
						<form style="display: inline-block;" action="{{ 		route('musics.destroy', ['id' => $music->id]) }}" method="post">
						<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete?';)">Delete</button>
						<input type="hidden" name="_method" value="DELETE">
						{{ csrf_field() }}
						</form>
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

@foreach($musics as $music)	
@endforeach

@endsection



@section('script')
<script>
$(document).ready(function(){
    $.ajax({
        type:"get",
        url :("http://127.0.0.1:8000/music/playlistViewByGenre/{{Auth::user()->id }}/?genre={{ $music->genre}}"),
        success:function(data){
            tracks=data;
            $.each(data,function(i,song){
                num=i+1;
                var lists='<li>'+
                            '<div class="plItem">'+
                            '<div class="plItem">'+ zeroPad(num,2) +'.</div>'+                            
                            '<div class="plItem">'+ song.Song_name +'</div>'+
                            '</div>'+
                            '</li>';
                    $('#plList').append(lists);
            })

            actionAudio();
    }
    });

});

</script>
@endsection

