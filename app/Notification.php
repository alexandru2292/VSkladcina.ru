<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'notification', 'sender_user_id'];
    protected $guarded = ['user_id', 'notification', 'sender_user_id'];
}
