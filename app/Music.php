<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [ 'tag' , 'Song_name' , 'artist_id',
'album_id', 'count' ,'language','song_file','genre'];
}
?>