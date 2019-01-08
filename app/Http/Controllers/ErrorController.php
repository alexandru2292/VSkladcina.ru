<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ErrorController extends Controller
{
    public function notfound()
    {
        $header = view(config('settings.theme').'.header')->render();
        $content = view(config('settings.theme').'.404content')->render();
        return view('errors.404')->with(['header'=>$header, 'content' => $content]);
    }

}