<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
    'artist_id',
    'genre',
    'title',
    'released_year',
    'description',
    'album_art'
    ];
    public function musics()
    {
    	return $this->hasMany(\App\Music::class);
    }
}
