@extends('master')
@extends('layouts.app')
@section('title', 'Create Artists')

@section('mastercontent')

<form action="{{ route('artists.store') }}" method="post">
        <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    </div>
    <div class="form-group">
    <label for="description">description:</label>
    <input type="text" id="description" name="description">
    </div>
    <div class="form-group">
        <button type="submit">Save</button>
     </div>
    {{ csrf_field() }}
    </form>
@endsection