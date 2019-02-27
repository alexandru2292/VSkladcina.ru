<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Menu;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{

    protected $stockRepository;
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
       return view($this->template)->with($this->vars);//
    }
    protected function renderOutputAdmin(){
        $userRole = Auth::user()->load("role_user")->role_user->load("role")->role->alias;
        if($userRole == "Admin"){
            /* Header */
            $header = view(config('settings.theme').'.admin.header')->render();
            $this->vars = array_add($this->vars,'header', $header);
            /* /Header */

            if($this->content){
                $this->vars = array_add($this->vars, 'content', $this->content);
            }

            return view($this->template)->with($this->vars);//
        }else{
            return abort(404);
        }

    }
}
