@extends('master')
@extends('layouts.app')
@section('title','Sangeet Album')

@section('mastercontent')
<table class="table table-striped">
	<thead>
		<tr>
			<td>ID</td>
			<td>Album Art</td>
			<td>Title</td>
			<td>Artist</td>
			<td>Genre</td>
			<td>Released Year</td>
			<td>Description</td>
		</tr>
	</thead>	
	<tbody>
		 @foreach($albums as $album)
		<tr>
			<td>{{ $album->id }}</td>
			<td>
			<object data="{{ URL::to('/')}}/albumart/{{$album->album_art}}" type="image/png" width="80" height="80">
    		<img src="{{ URL::to('/')}}/albumart/default.jpg" width="80" height="80" >
  			</object>
			</td>
			<td>{{ $album->title }}</td>
			<td>
			@foreach($artists as $artist)
                  @if($artist['id']==$album['artist_id'])
                    {{ $artist->name}}
                  @endif
              @endforeach
            </td>
			<td>{{ $album->genre }}</td>
			<td>{{ $album->released_year }}</td>
			<td>{{ $album->description }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection