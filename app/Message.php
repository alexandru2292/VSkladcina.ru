<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   protected $fillable = ['user_id', 'message', 'sender_user_id'];
   protected $guarded = ['user_id', 'message', 'sender_user_id'];
}
