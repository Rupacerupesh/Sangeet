<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\PlaylistSong;

use Illuminate\Http\Request;

class PlaylistSongController extends Controller
{
       public function __construct( Playlist $playlist, PlaylistSong $playlist_song)
    {
        $this->middleware('auth');
        $this->playlist = $playlist;
        $this->playlist_song = $playlist_song;
    }

    public function store(Request $request)
    {
        $playlist_song = $this->playlist_song->create($request->all());
        return redirect()
            ->route('musics.index')
            ->with('success', sprintf("Song added successfully ."));
    }
}
