<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controller\EveningController;

class Evening extends Model
{
    protected $fillable = [ 'id' , 'user_id' , 'Rock' , 'Pop', 'Metal' ,'Bhajan','Alternative','Dance','RnB','HipHop','Country','Classic','Instrumental','Romance'];
}
