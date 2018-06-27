<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controller\LateNightController;	

class LateNight extends Model
{
    protected $fillable = [ 'id' , 'user_id' , 'Rock' , 'Pop', 'Metal' ,'Bhajan','Alternative','Dance','RnB','HipHop','Country','Classic','Instrumental','Romance'];
    public function users()
    {
    	return $this->hasMany(\App\User::class);
    }
}
