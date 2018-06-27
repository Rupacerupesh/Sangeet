<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\PlaylistSong;

use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function __construct( Playlist $playlist, PlaylistSong $playlist_song)
    {
        $this->middleware('auth');
        $this->playlist = $playlist;
        $this->playlist_song = $playlist_song;
    }
      public function create()
    {
        $playlists = $this->playlist->all();
        return view('playlist.create',compact('playlists'));
    }
    
    public function store(Request $request)
    {
        $playlist = $this->playlist->create($request->all());
        return redirect()->route('musics.index');
    }

    public function show(Request $request,$id)
    {
        $playlist = $request->input('id');
        dd($id,$playlist);
    }
}
