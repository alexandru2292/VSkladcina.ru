<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'message', 'sender_user_id'];
   protected $guarded = ['user_id', 'message', 'sender_user_id'];

   public function hasUser(){
       return $this->hasOne('App\user', 'id', 'user_id');
   }
   public function hasSender(){
       return $this->hasOne('App\user', 'id', 'sender_user_id');
   }
}
