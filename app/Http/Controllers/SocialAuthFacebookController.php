<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(Request $request)
    {
        echo "<h4 style='color:#ff4344;'> Codul erorii: " .$request->error_code. "</h4><hr><h3 style='color:#ff413c;'>" . $request->error_message ."</h3>";
    }
}
