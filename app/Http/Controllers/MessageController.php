<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends SiteController
{
    public function __construct()
    {
        $this->template = config('settings.theme').'.index';
    }

    public function showMessages(){
        $this->content = view(config('settings.theme').'.messages')->render();
        return $this->renderOutput();
    }
}
