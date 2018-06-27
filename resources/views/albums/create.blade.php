@extends('master')
@extends('layouts.app')
@section('title','Add Album')
@section('mastercontent')
<form action="{{ route('albums.store') }}" enctype="multipart/form-data" method="post">
		<div class="form-group">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">
    </div>
    <div class="form-group">
    <label for="artist_id">Artist:</label>
    <select class="form-control" id="artist_id" name="artist_id">
                @foreach($artists as $artist)
                  <option value="{{$artist->id}}">{{$artist->name}}</option>
                 @endforeach
    </select>             
    </div>
    <div class="form-group">
    <label for="released_year">Date:</label>
    <input type="text" id="released_year" name="released_year">
    </div>
    <div class="form-group">
    <label for="genre">Genre: </label>
    <select class="form-control" id="genre" name="genre">
    <option value="Rock">Rock</option>
    <option value="Pop">Pop</option>
    <option value="Bhajan">Bhajan</option>
    <option value="Alternative">Alternative</option>
    <option value="Dance">Dance</option>
    <option value="RnB">RnB</option>
    <option value="HipHop">HipHop</option>
    <option value="Country">Country</option>
    <option value="Classic">Classic</option>
    <option value="Instrumental">Instrumental</option>
    
    </select> 
   </div>
     <div class="form-group">
    <label for="description">description:</label>
    <input type="text" id="description" name="description">
    </div>
    <div class="form-group">
	  <label for="album_art">Input Album Art: </label>
  	<input type="file" class="form-control" name="album_art">
    </div>
    <div class="form-group">
        <button type="submit">Save</button>
     </div>
	{{ csrf_field() }}
	</form>
@endsection