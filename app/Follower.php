<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public function hasUser(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
