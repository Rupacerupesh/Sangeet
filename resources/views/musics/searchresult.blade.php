@extends('layouts.app')

@section('title','Recommended For You')
@section('content')

        <h3 align="center">Search Resulted the following songs.</h3>  
@include('musics.allview')  




        <h4>Search Resulted the following artists.</h4>  

        <div class="table-responsive">
		<table class="table">
		 
                    

                            @foreach($artistsearch as $artist)
                            	<tr>
                            	<td>
								<a href="{{ route('musics.ViewByArtist', ['artist_id' => $artist->id]) }}">   
                                    {{ $artist->name}}</a>
                                    
                                    </td>
                                 </tr>

                              @endforeach
                    
                    
                    </table>
                    </div>	

@endsection