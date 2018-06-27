<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use App\Album;
use App\Artist;
use App\Playlist;
use App\PlaylistSong;
use Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    protected $album = null;
    protected $artist = null;
     protected $playlist = null;
    protected $playlist_song = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Album $album,Artist $artist, Playlist $playlist)
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->album = $album;
        $this->artist = $artist; 
         $this->playlist = $playlist;
    }
    public function index()
    {
        $albums = $this->album->all();
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        return view('albums.index' , compact('albums','artists','playlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        return view('albums.create',compact('artists','playlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $file = $request->file('album_art');
        $album_art = date('Ymdhis') . '.' . $file->extension();
        $file->move(public_path().'/albumart', $album_art);
        $album = $this->album->create(array_merge(compact('album_art'), $request->except('album_art')));           
       return redirect()
            ->route('albums.index')
           ->with('success', sprintf("Album `%s` added successfully.", $album->album_art));
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
