@extends('master')
@extends('layouts.app')

@section('title', 'Edit Song')
@section('subtitle','Select your mood')
@section('mastercontent')
	<form action="{{ route('musics.update', ['id' => $music->id]) }}" enctype="multipart/form-data" method="post">
		@include('musics._form-elements')
        <input type="hidden" name="_method" value="put">
		{{ csrf_field() }}
	</form>
@endsection