@extends('master')
@extends('layouts.app')

@section('title', 'Add New Songs')
@section('subtitle','Select your mood')
@section('mastercontent')
	<form action="{{ route('musics.store') }}" enctype="multipart/form-data" method="post">
		@include('musics._form-elements')
		{{ csrf_field() }}
	</form>
@endsection