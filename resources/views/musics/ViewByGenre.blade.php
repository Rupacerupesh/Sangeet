@extends('master')
@extends('layouts.app')

@section('title','View Song')

@section('mastercontent')
@include('musics.allview')
@foreach($musics as $music)
@endforeach

@endsection


@section('script')
<script>
$(document).ready(function(){
    $.ajax({
        type:"get",
        //url :("http://127.0.0.1:8000/music/playlistViewByGenre/{{Auth::user()->id }}/?genre={{ $music->genre}}"),
        success:function(data){
            tracks=data;
            $.each(data,function(i,song){
                num=i+1;
                var lists='<li>'+
                            '<div class="plItem">'+
                            '<div class="plItem">'+ zeroPad(num,2) +'.</div>'+                            
                            '<div class="plItem">'+ song.Song_name +'</div>'+
                            '</div>'+
                            '</li>';
                    $('#plList').append(lists);
            })

            actionAudio();
    }
    });

});

</script>
@endsection
