<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function mysql_xdevapi\getSession;


class ProfileController extends SiteController
{
    public function __construct()
    {
        $this->template = config('settings.theme').'.profile';
    }

    public function index(Request $request){

        $user = Auth::user();
        $user->load('role_user');

        if (strpos($user->avatar, 'link=1') !== false) {
            $user->HasLinkAvatar = 1;
        }
        if($user){
            $this->content = view(config('settings.theme').'.contentProfile')->with(['user' => $user])->render();
            return $this->renderOutput();
        }else{
            return redirect('/');
        }
    }


}
