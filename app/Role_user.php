<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    public function role(){
        return $this->belongsTo('App\Role');
    }
}
