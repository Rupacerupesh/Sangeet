
@php
	$music = @@isset($music) ? $music : (object) [
		'tag' => '',
		'Song_name' => '',
		'artist_id' => '',
		'album_id' => '',
		'count' => '',
		'language' => '',
		'song_file' => '',
		'genre'=>'',
	];
@endphp

<div class="form-group">
	<label for="tag">Tag: </label>
		<select class="form-control" id="tag" name="tag">
	  <option value="Sad">Sad</option>
	  <option value="Happy">Happy</option>
	  <option value="Neutral">Neutral</option>
	  <option value="Romance">Romance</option>
	  	  <option value="Romance">Aggressive</option>
		</select> 
</div>
<div class="form-group">
	<label for="phone">Song Name: </label>
	<input type="text" class="form-control" id="Song_name" name="Song_name" value="{{ old('Song_name', $music->Song_name) }}">
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
    <option value="Romance">Romance</option>
    </select> 
</div>
<div class="form-group">
	<label for="artist_id">Artist: </label>
	 <select name="artist_id" id="artist_id" class="form-control input-sm">
				@foreach($artists as $artist)
                  <option value="{{$artist->id}}">{{$artist->name}}</option>
                 @endforeach
           </select>
</div>
<div class="form-group">
	<label for="album">Album: </label>
	<select class="form-control" id="album_id" name="album_id">
                @foreach($albums as $album)
                  <option value="{{$album->id}}">{{$album->title}}</option>
                 @endforeach
    </select>
<div class="form-group">
	<label for="language">Language: </label>
		<select class="form-control" id="language" name="language">
	  <option value="English">English</option>
	  <option value="Hindi">Hindi</option>
	  <option value="Nepali">Nepali</option>
	  <option value="Other">Other</option>
		</select> 
</div>
</div>
<div class="form-group">
	<label for="song_file">Input Song: </label>
	<input type="file" class="form-control" name="song_file" >
</div>
<div class="form-group">
	<input type="hidden" class="form-control" id="count" name="count" value="{{ $c }}">
</div>
<div class="form-group">
	<button class="btn btn-success" type="submit">Save</button>
	<a href="{{ route('musics.index') }}" class="btn btn-danger">Cancel</a>
</div>
