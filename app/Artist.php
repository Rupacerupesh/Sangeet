<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [ 'name', 'description' ];

    public function albums()
    {
    	return $this->hasMany(\App\Album::class);
    }
}
