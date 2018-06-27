@extends('master')
@extends('layouts.app')

@section('title', 'Add New Songs')
@section('subtitle','Select your mood')
@section('mastercontent')
	<form action="{{ route('playlist.store') }}"  method="post">
    <div class="form-group">
	<label for="Name">Playlist Name: </label>
	<input type="text" class="form-control" id="Name" name="Name" value="">
    </div>
    <div style="display:none" class="form-group">
	<label for="user_id">User </label>
	<input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    </div>
    <div class="form-group">
	<button class="btn btn-success" type="submit">Save</button>
	<a href="{{ route('musics.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    {{ csrf_field() }}
	</form>
@endsection
