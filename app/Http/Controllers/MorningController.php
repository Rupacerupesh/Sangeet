<?php

namespace App\Http\Controllers;

use App\Morning;
use App\Playlist;
use App\PlaylistSong;
use Illuminate\Http\Request;

class MorningController extends Controller
{
    protected $morning = null;
        protected $playlist = null;
    protected $playlist_song = null;

    public function __construct(Morning $morning, Playlist $playlist, PlaylistSong $playlist_song)
    {
        // $this->middleware('auth');
        $this->morning = $morning;
        $this->playlist = $playlist;
        $this->playlist_song = $playlist_song;
    } 


    public function index()
    {
        $playlists = $this->playlist->all();
        return view('mornings.index', compact('playlists'));
    }
    public function store(Request $request)
    {
        $morning = $this->morning->create($request->all());
        return redirect()->route('mornings.index');
    }

}
