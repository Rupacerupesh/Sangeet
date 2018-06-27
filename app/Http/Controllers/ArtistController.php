<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist;
use App\Playlist;
use App\PlaylistSong;

class ArtistController extends Controller
{
    /**
     * @var \App\Album;
     */
    protected $artist = null;
    protected $playlist = null;
    protected $playlist_song = null;

    /**
     * Constructor
     * 
     * @param \App\Model $album
     */
    public function __construct(Artist $artist, Playlist $playlist, PlaylistSong $playlist_song)
    {
        $this->artist = $artist; 
        $this->playlist = $playlist;
        $this->playlist_song = $playlist_song;       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        return view('artists.index', compact('artists','playlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $playlists = $this->playlist->all();
        return view('artists.create',compact('playlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artist = $this->artist->create($request->all());
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
