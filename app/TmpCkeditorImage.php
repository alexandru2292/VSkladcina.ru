<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpCkeditorImage extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'save'];
}
