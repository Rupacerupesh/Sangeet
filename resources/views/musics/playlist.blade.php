@extends('master')
@extends('layouts.app')

@section('title','My Playlist')
@section('mastercontent')
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Song Name</th>
				<th>Artist</th>
				<th>Album</th>
				<th>Actions</th>
				<th>Play</th>
			</tr>
		</thead>
		<tbody>
			@forelse($musics as $music)
            @foreach($playlist_songs as $playlist_song)
                  @if($playlist_song['song_id']==$music['id'])
				<tr>
					<td>{{ $music->Song_name }}  {{ $playlist_song->playlist_id }} </td>
					<td><a href="{{ route('musics.ViewByArtist', ['artist_id' => $music->artist_id]) }}">@foreach($artists as $artist)
                  @if($artist['id']==$music['artist_id'])
                    {{ $artist->name}}
                  @endif
              @endforeach</a></td>
					<td>@foreach($albums as $album)
                  @if($album['id']==$music['album_id'])
                    {{ $album->title}}
                  @endif
              @endforeach</td>
					<td>
						@if(Auth::user())
						<a href="{{ route('musics.newshow', ['id' => $music->id , 'uid' => Auth::user()->id ,'gen' => $music->genre  ] ) }}" class="btn btn-sm btn-info">Show user</a>
						@else
						<a href="{{ route('musics.show', ['id' => $music->id]) }}" class="btn btn-sm btn-info">Show</a>
						@endif					
						<a href="{{ route('musics.edit', ['id' => $music->id]) }}" class="btn btn-sm btn-info">Edit</a>
						<form style="display: inline-block;" action="{{ 		route('musics.destroy', ['id' => $music->id]) }}" method="post">
						<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete?');">Delete</button>
						<input type="hidden" name="_method" value="DELETE">
						{{ csrf_field() }}
						</form>
					</td>
					<td>
						<audio controls>
								<source src="{{ URL::to('/')}}/songs/{{$music->song_file}}" type="audio/mpeg">
						</audio>
					</td>
				</tr>                   
                 @endif
              @endforeach
				@empty
					<tr>
						<td colspan="3">No records found.</td>
					</tr>

			@endforelse
		</tbody>
	</table>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
    $.ajax({
        type:"get",
        url :("http://127.0.0.1:8000/music/playlistplaylist/?playlist_id={{ $playlist_song->playlist_id }}"),
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

