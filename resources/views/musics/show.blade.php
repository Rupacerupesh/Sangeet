@extends('master')
@extends('layouts.app')

@section('title', 'Show Music')

@section('mastercontent')
	<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered">
			<tr>
				<th>Tag </th>
				<td>{{ $music->tag }}</td>
			</tr>
			<tr>
				<th>Genre </th>
				<td>{{ $music->genre }}</td>
			</tr>
			
			<tr>
				<th>Song Name :</th>
				<td>{{ $music->Song_name }}</td>
			</tr>
			<tr>
				<th>Artist</th>
				@foreach($artists as $artist)
				@if($artist['id']==$music['artist_id'])
                                       <td> {{ $artist->name}}<br>{{ $artist->description}}</td>
                  @endif
              @endforeach

			</tr>
			<tr>
				<th>Album</th>
				@foreach($albums as $album)
                  @if($album['id']==$music['album_id'])
                  <td>
			<object data="{{ URL::to('/')}}/albumart/{{$album->album_art}}" type="image/png" width="80" height="80">
    		<img src="{{ URL::to('/')}}/albumart/default.jpg" width="80" height="80" >
  			</object>
			<b>{{ $album->title}}</b></td>
                  @endif
              @endforeach
			</tr>
			<tr>
				<th>Created At</th>
				<td>{{ $music->created_at }}</td>
			</tr>
			<tr>
				<th>Updated At</th>
				<td>{{ $music->updated_at }}</td>
			</tr>
			<tr>
				<th>Plays</th>
				<td>{{ $music->count }}</td>
			</tr>

		</table>
	</div>
@endsection