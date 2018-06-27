@extends('master')
@extends('layouts.app')
@section('title', 'Artists Index')
@section('mastercontent')
<h3>Artists table</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
      </tr>
    </thead>
    <tbody>
      @foreach($artists as $artist)
        <tr>
          <td>{{ $artist->name }}</td>
          <td>{{ $artist->description }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection