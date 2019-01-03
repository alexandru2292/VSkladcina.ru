<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Menu;

class SiteController extends Controller
{

    protected $stockRep;
    protected $pl_room_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $content = false;
    protected $template;

    protected $vars = [];

    public function __construct()
    {

    }
    protected function renderOutput(){

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);
        /* Header */
        $header = view(config('settings.theme').'.header')->render();

        $this->vars = array_add($this->vars,'header', $header);
        /* /Header */

        if($this->content){
            $this->vars = array_add($this->vars, 'content', $this->content);
        }
        /* Footer */
        $footer = view(config('settings.theme').'.footer')->render();
        $this->vars = array_add($this->vars,'footer', $footer);
        /* /Footer */

       //this->template este reatribuit in IndexController in met __construct() { parent::__construct(); $this->template = env('THEME'.'.index'); }
       return view($this->template)->with($this->vars);//
    }

}
