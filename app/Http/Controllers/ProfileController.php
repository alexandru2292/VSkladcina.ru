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
        /**
         * @if the user is logged in we, get from session the dates
         * @else the user dates is null!
         */
        $logginedUser = null;
        if(session('loggedInUser')){
            $logginedUser = session('loggedInUser');
            $logginedUser = User::find($logginedUser);
        }
        /**
         * if the user is logged in, it allows entry on the profile page
         */
        if($logginedUser){
            $this->content = view(config('settings.theme').'.contentProfile')->with(['user' => $logginedUser])->render();
            return $this->renderOutput();
        }else{
            return redirect('/');
        }
    }

    public function exitFromProfile(){
        if(session('loggedInUser')){
            /**
             * Delete user from session  and Exit from Profile
             */
            \Session::forget('loggedInUser');
            return redirect('/');
        }
    }
}
