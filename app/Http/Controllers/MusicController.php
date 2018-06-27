<?php

namespace App\Http\Controllers;

use App\Music;
use App\Morning;
use App\Noon;
use App\Evening;
use App\Night;
use App\LateNight;
use App\Album;
use App\Artist;
use App\Playlist;
use App\PlaylistSong;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\MusicsRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MusicController extends Controller
{
    /**
     * @var \App\Music;
     */
    protected $music = null;
    protected $album = null;
    protected $artist = null;
    protected $morning = null;
    protected $noon = null;
    protected $evening = null;
    protected $night = null;
    protected $latenight = null;
    protected $user = null;
    protected $playlist = null;
    protected $playlist_song = null;
   
    /**
     * Constructor
     * 
     * @param \App\Model $music
     */
    public function __construct(Music $music, Album $album, Artist $artist, Morning $morning , Noon $noon ,Evening $evening, Night $night, Latenight $latenight, Playlist $playlist, PlaylistSong $playlist_song)
    {
        $this->middleware('auth', ['except' => ['index','show','mood','toplist','search','ViewByArtist','ViewByAlbum']]);
        $this->music = $music;
        $this->album = $album;
        $this->artist = $artist;
        $this->morning = $morning;
        $this->noon = $noon;
        $this->evening = $evening;
        $this->night = $night;
        $this->latenight = $latenight;
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
        $musics = $this->music->all();
        $albums = $this->album->all();
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        return view('musics.index', compact('musics','artists','albums','playlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $musics = $this->music->all();
        $artists = $this->artist->all();
        $albums = $this->album->all();
        $playlists = $this->playlist->all();
        $c=0;
        return view('musics.create',compact('musics','artists','albums','c','playlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MusicsRequest $request)
    {
        $file = $request->file('song_file');
        $song_file = date('Ymdhis') . '.' . $file->extension();
        $file->move(public_path().'/songs', $song_file);
        $music = $this->music->create(array_merge(compact('song_file'), $request->except('song_file')));           
       return redirect()
            ->route('musics.index')
           ->with('success', sprintf("Song `%s` added successfully.", $music->Song_name));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        if (is_null($music)) {
            abort(404);
        }
        $music->increment('count');

        return view('musics.show', compact('music','albums','artists','playlists'));
    }
    
    public function playlist($id){
       
        $playlist_songs = $this->playlist_song->where( 'playlist_id' , '=', $id  )->get();
        $playlists = $this->playlist->all();
        $musics = $this->music->all();
        $artists = $this->artist->all();
        $albums = $this->album->all();
        if (is_null($musics)) {
            abort(404);
        }

        return view('musics.playlist', compact('musics','albums','artists','playlist_songs','playlists'));
       
    }

     public function newshow($id , $uid ,$gen){
        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }
        $music->increment('count');

        return view('musics.show', compact('music','albums','artists','playlists'));

     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $music = $this->music->find($id);
        $albums = $this->album->all();
        $artists = $this->artist->all();
        $playlists = $this->playlist->all();
        if (is_null($music)) {
            abort(404);
        }
        $c=$music->count;
        return view('musics.edit', compact('music','albums','artists','c','playlists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(MusicsRequest $request, $id)
    {
        $music = $this->music->find($id);

        if (is_null($music)) {
            abort(404);
        }

        $music->tag = $request->get('tag');
        $music->Song_name = $request->get('Song_name');
        $music->artist_id = $request->get('artist_id');
        $music->album_id = $request->get('album_id');
        $music->count = $request->get('count');
        $music->language = $request->get('language');
        $music->song_file = $request->get('song_file');
        $music->genre = $request->get('genre');
        $file = $request->file('song_file');
        $song_file = date('Ymdhis') . '.' . $file->extension();
        $file->move(public_path().'/songs', $song_file);
        $music->song_file = $song_file; 

        $music->save();

        return redirect()
            ->route('musics.index')
            ->with('success', sprintf("Music \" %s \" updated successfully.", $music->Song_name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $music = $this->music->find($id);

        if (is_null($music)) {
            abort(404);
        }

        $music->delete();
        
        return redirect()
            ->route('musics.index')
            ->with('success', sprintf("Music \" %s \" deleted successfully.", $music->Song_name));
    }
    public function mood($tag)
    {
       $musics = $this->music->where( 'tag' , '=', $tag  )->get();
       $artists = $this->artist->all();
       $albums = $this->album->all();
       $playlists = $this->playlist->all();
        if (is_null($musics)) {
            abort(404);
        }

        return view('musics.mood', compact('musics','albums','artists','playlists'));
    }
    public function toplist()
    {
        $musics = $this->music->orderBy('count', 'DESC')->get();
        $artists = $this->artist->all();
        $albums = $this->album->all();
        $playlists = $this->playlist->all();
        return view('musics.toplist', compact('musics','albums','artists','playlists'));
    }
     public function recommended($uid)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();  
        $playlists = $this->playlist->all();
        $nowtime=Carbon::now()->hour;
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  )->first();
         $maxm=max($morning->Rock,$morning->Pop,$morning->Metal,$morning->Bhajan,$morning->Alternative,$morning->Dance,$morning->RnB,$morning->HipHop,$morning->Country,$morning->Instrumental,$morning->Romance);
        if($maxm == $morning->Rock)
                $maxgen="Rock";
        if($maxm == $morning->Pop)
                $maxgen="Pop";
        if($maxm == $morning->Metal)
                $maxgen="Metal";
        if($maxm == $morning->Bhajan)
                $maxgen="Bhajan";
        if($maxm == $morning->Alternative)
                $maxgen="Alternative";
        if($maxm == $morning->Dance)
                $maxgen="Dance"; 
        if($maxm == $morning->RnB)
                $maxgen="RnB";
        if($maxm == $morning->HipHop)
                $maxgen="HipHop"; 
        if($maxm == $morning->Country)
                $maxgen="Country"; 
        if($maxm == $morning->Classic)
                $maxgen="Classic"; 
        if($maxm == $morning->Instrumental)
                $maxgen="Instrumental"; 
        if($maxm == $morning->Romance)
                $maxgen="Romance";
         $musics = $this->music->where( 'genre' , '=', $maxgen  )->get();

        if (is_null($musics)) {
            abort(404);
        }
        $greet = "Morning";
        return view('musics.recommended', compact('musics','albums','artists','greet','playlists'));
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  )->first();
        $maxm=max($noon->Rock,$noon->Pop,$noon->Metal,$noon->Bhajan,$noon->Alternative,$noon->Dance,$noon->RnB,$noon->HipHop,$noon->Country,$noon->Instrumental,$noon->Romance);
        if($maxm == $noon->Rock)
                $maxgen="Rock";
        if($maxm == $noon->Pop)
                $maxgen="Pop";
        if($maxm == $noon->Metal)
                $maxgen="Metal";
        if($maxm == $noon->Bhajan)
                $maxgen="Bhajan";
        if($maxm == $noon->Alternative)
                $maxgen="Alternative";
        if($maxm == $noon->Dance)
                $maxgen="Dance"; 
        if($maxm == $noon->RnB)
                $maxgen="RnB";
        if($maxm == $noon->HipHop)
                $maxgen="HipHop"; 
        if($maxm == $noon->Country)
                $maxgen="Country"; 
        if($maxm == $noon->Classic)
                $maxgen="Classic"; 
        if($maxm == $noon->Instrumental)
                $maxgen="Instrumental"; 
        if($maxm == $noon->Romance)
                $maxgen="Romance";
         $musics = $this->music->where( 'genre' , '=', $maxgen  )->get();

        if (is_null($musics)) {
            abort(404);
        }
        $greet = "Afternoon";
        return view('musics.recommended', compact('musics','albums','artists','greet','playlists'));
        }
        if($nowtime>=16 && $nowtime <=20  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $maxm=max($evening->Rock,$evening->Pop,$evening->Metal,$evening->Bhajan,$evening->Alternative,$evening->Dance,$evening->RnB,$evening->HipHop,$evening->Country,$evening->Instrumental,$evening->Romance);
        if($maxm == $evening->Rock)
                $maxgen="Rock";
        if($maxm == $evening->Pop)
                $maxgen="Pop";
        if($maxm == $evening->Metal)
                $maxgen="Metal";
        if($maxm == $evening->Bhajan)
                $maxgen="Bhajan";
        if($maxm == $evening->Alternative)
                $maxgen="Alternative";
        if($maxm == $evening->Dance)
                $maxgen="Dance"; 
        if($maxm == $evening->RnB)
                $maxgen="RnB";
        if($maxm == $evening->HipHop)
                $maxgen="HipHop"; 
        if($maxm == $evening->Country)
                $maxgen="Country"; 
        if($maxm == $evening->Classic)
                $maxgen="Classic"; 
        if($maxm == $evening->Instrumental)
                $maxgen="Instrumental"; 
        if($maxm == $evening->Romance)
                $maxgen="Romance";
         $musics = $this->music->where( 'genre' , '=', $maxgen  )->get();

        if (is_null($musics)) {
            abort(404);
        }
        $greet = "Evening";
        return view('musics.recommended', compact('musics','albums','artists','greet','playlists'));
        }
        if($nowtime>=21 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  )->first();
         $maxm=max($night->Rock,$night->Pop,$night->Metal,$night->Bhajan,$night->Alternative,$night->Dance,$night->RnB,$night->HipHop,$night->Country,$night->Instrumental,$night->Romance);
        if($maxm == $night->Rock)
                $maxgen="Rock";
        if($maxm == $night->Pop)
                $maxgen="Pop";
        if($maxm == $night->Metal)
                $maxgen="Metal";
        if($maxm == $night->Bhajan)
                $maxgen="Bhajan";
        if($maxm == $night->Alternative)
                $maxgen="Alternative";
        if($maxm == $night->Dance)
                $maxgen="Dance"; 
        if($maxm == $night->RnB)
                $maxgen="RnB";
        if($maxm == $night->HipHop)
                $maxgen="HipHop"; 
        if($maxm == $night->Country)
                $maxgen="Country"; 
        if($maxm == $night->Classic)
                $maxgen="Classic"; 
        if($maxm == $night->Instrumental)
                $maxgen="Instrumental"; 
        if($maxm == $night->Romance)
                $maxgen="Romance";
         $musics = $this->music->where( 'genre' , '=', $maxgen  )->get();

        if (is_null($musics)) {
            abort(404);
        }
        $greet = "Night";
        return view('musics.recommended', compact('musics','albums','artists','greet','playlists'));
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  )->first();
         $maxm=max($latenight->Rock,$latenight->Pop,$latenight->Metal,$latenight->Bhajan,$latenight->Alternative,$latenight->Dance,$latenight->RnB,$latenight->HipHop,$latenight->Country,$latenight->Instrumental,$latenight->Romance);
        if($maxm == $latenight->Rock)
                $maxgen="Rock";
        if($maxm == $latenight->Pop)
                $maxgen="Pop";
        if($maxm == $latenight->Metal)
                $maxgen="Metal";
        if($maxm == $latenight->Bhajan)
                $maxgen="Bhajan";
        if($maxm == $latenight->Alternative)
                $maxgen="Alternative";
        if($maxm == $latenight->Dance)
                $maxgen="Dance"; 
        if($maxm == $latenight->RnB)
                $maxgen="RnB";
        if($maxm == $latenight->HipHop)
                $maxgen="HipHop"; 
        if($maxm == $latenight->Country)
                $maxgen="Country"; 
        if($maxm == $latenight->Classic)
                $maxgen="Classic"; 
        if($maxm == $latenight->Instrumental)
                $maxgen="Instrumental"; 
        if($maxm == $latenight->Romance)
                $maxgen="Romance";
         $musics = $this->music->where( 'genre' , '=', $maxgen  )->get();

        if (is_null($musics)) {
            abort(404);
        }
        $greet = "Night";
        return view('musics.recommended', compact('musics','albums','artists','greet','playlists'));
        }
    }
    /**
     * 
     * Generating trending songs
     * hitrate = count/(strtotime($music->updated_at) - strtotime($music->created_at))
     * select id, created_at, updated_at, (unix_timestamp(now()) - unix_timestamp(created_at)) as hitrate from musics;

     * then order by highest rate
     * 
     * */
    public function hitRate()
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
        $music = $this->music->orderBy('hitrate','DESC')->get();
        return view('musics.mood', compact('musics','albums','artists'));
    }
    
     public function ViewByArtist($artist_id)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
       $musics = $this->music->where( 'artist_id' , '=', $artist_id  )->get();
        $playlists = $this->playlist->all();
        if (is_null($musics)) {
            abort(404);
        }

        return view('musics.ViewByArtist', compact('musics','albums','artists','playlists'));
   
    }
    public function ViewByLanguage($language)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
       $musics = $this->music->where( 'language' , '=', $language  )->get();
        $playlists = $this->playlist->all();
        if (is_null($musics)) {
            abort(404);
        }

        return view('musics.ViewByLanguage', compact('musics','albums','artists','playlists'));
   
    }
    
    public function ViewByGenre($genre)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
       $musics = $this->music->where( 'genre' , '=', $genre  )->get();
        $playlists = $this->playlist->all();

        if (is_null($musics)) {
            abort(404);
          
        }

        return view('musics.ViewByGenre', compact('musics','albums','artists','playlists'));
   
    }
    public function ViewSong($id)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
       $musics = $this->music->where( 'id' , '=', $id  )->get();
          $playlists = $this->playlist->all();
     
        if (is_null($musics)) {
            abort(404);
        }
        return view('musics.ViewSong', compact('musics','albums','artists','playlists'));
    }
    public function ViewByAlbum($album_id)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
       $musics = $this->music->where( 'album_id' , '=', $album_id  )->get();
          $playlists = $this->playlist->all();
     
        if (is_null($musics)) {
            abort(404);
        }
        return view('musics.ViewByAlbum', compact('musics','albums','artists','playlists'));
    }

    
    public function search(Request $request)
    {
        $artists = $this->artist->all();
        $albums = $this->album->all();
        $searchItem = $request->searchItem;
        $playlists = $this->playlist->all();
        $musics = $this->music->where( 'Song_name','LIKE','%'.$searchItem.'%')->get();
                $artistsearch = $this->artist->where( 'name','LIKE','%'.$searchItem.'%')->get();
       // return $musics; 
        if(count($musics)==0 && count($artistsearch)==0){
            $searchResult[] = 'No Songs Found';
        }
        else{
            foreach($musics as $key => $value){
                $searchResult[] = $value->Song_name;
            }
            foreach ($artistsearch as $key => $value) {
                $searchResult[] = $value->name; 
            }
        }
        return view('musics.searchresult', compact('musics','artistsearch','albums','artists','playlists'));       
    }

        public function playlistIndex($uid){
        $musics = $this->music->orderBy('id', 'DESC')->get();

         $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
       



        return response()->json($musics);
    }


    public function playlistViewByArtist($uid, Request $request){
        $artist_id = $request->query('artist_id');
        $musics = $this->music->where( 'artist_id', $artist_id  )->get();

       

 $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
       
        return response()->json($musics);
    }

      public function playlistViewByGenre($uid, Request $request){
        $genre = $request->query('genre');
        $musics = $this->music->where( 'genre', $genre  )->get();

       

 $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
       
        return response()->json($musics);
    }
    public function playlistViewByLanguage($uid, Request $request){
        $language = $request->query('language');
        $musics = $this->music->where( 'language', $language  )->get();
        
 $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
        return response()->json($musics);
    }
    public function playlistmood($uid, Request $request){
        $tag = $request->query('tag');
        $musics = $this->music->where( 'tag', $tag  )->get();

       $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
 
        return response()->json($musics);
    }
    public function playlisttoplist($uid){
        $musics = $this->music->orderBy('count', 'DESC')->take(10)->get();
        $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
 
        return response()->json($musics);
    }
        public function playlistViewSong($uid, Request $request){
        $id = $request->query('id');
        $musics = $this->music->where( 'id', $id  )->get();
        $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

            
        foreach ($musics as $music) {
         $music->increment('count');
        
        
        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }
    }
        return response()->json($musics);
    }
    public function playlistViewByAlbum($uid, Request $request){
        $album_id = $request->query('album_id');
        $musics = $this->music->where( 'album_id', $album_id  )->get();

        $id=$this->music->orderBy('id','DESC')->take(1)->get()->pluck('id');
        
           $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

         foreach ($musics as $music) {
            $music->increment('count');


        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

        }
 
        return response()->json($musics);
    }

    public function autoplaylist(Request $request){
        $id = $request->query('id');

        $musics = $this->music->where( 'id', $id  )->first();
        $similarartist=($musics->artist_id);
        $similargenre=($musics->genre);
        $similarmood=($musics->tag);
        $similaralbum=($musics->album_id);
        $similarlanguage=($musics->language);
        $songs = $this->music->all();
        foreach ($songs as $song) {

          $gen=$this->music->where('id','=',$id)->pluck('genre');
            $gen=(str_replace( array('[',']') , ''  , $gen ));
            $gen= str_replace('"', '', $gen);

        $nowtime=Carbon::now()->hour;
        $music = $this->music->find( $id );
        $albums = $this->album->all();
        $artists = $this->artist->all();
        if($nowtime>=4 && $nowtime <=9  ){
        $morning = $this->morning->where( 'user_id' , '=', $uid  );
        $morning->increment($gen);
        }
        if($nowtime>=10 && $nowtime <=15  ){
        $noon = $this->noon->where( 'user_id' , '=', $uid  );
        $noon->increment($gen);
        }
        if($nowtime>=16 && $nowtime <=21  ){
        $evening = $this->evening->where( 'user_id' , '=', $uid  )->first();
        $evening->increment($gen);
        }
        if($nowtime>=22 && $nowtime <=23  ){
        $night = $this->night->where( 'user_id' , '=', $uid  );
        $night->increment($gen);
        }
        if($nowtime>=0 && $nowtime <=3  ){
        $latenight = $this->latenight->where( 'user_id' , '=', $uid  );
        $latenight->increment($gen);
        }

            $song->similaritymatch=0;
            if($song->id==$id)
                $song->similaritymatch = 100; 

            if($song->artist_id==$similarartist)
                $song->similaritymatch += 5;

            if($song->album_id==$similaralbum)
                $song->similaritymatch += 5;            

            if($song->genre==$similargenre)
                $song->similaritymatch += 5;             

            if($song->tag==$similarmood)
                $song->similaritymatch += 5;

            if($song->language==$similarlanguage)
                $song->similaritymatch += 10;            
               $song->increment('count');
        }
       return response()->json(array_values(collect($songs)->sortBy('similaritymatch')->reverse()->toArray()));
    }
    public function playlistplaylist(Request $request)
    {
        $playlist_id = $request->query('playlist_id');
         $playlist_songs = $this->playlist_song->where( 'playlist_id' , '=', $playlist_id  )->get();

        foreach ($playlist_songs as $playlist_song) {
            $musics = $this->music->where( 'id', $playlist_song->song_id )->get();
            }
         
        return response()->json($musics);
        
}
}   