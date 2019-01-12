<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            /**
             * Delete session register
             */
            if(session('registerError')){
                \Session::forget('registerError'); // uita sessiunea
             }
            return redirect('/profile');
        }

        /**
         * Set a variable in a session to open the LOGIN div.
         */
        session(['loginError' => 1] );
        /**
         * Delete session register
         */
        if(session('registerError')){
            \Session::forget('registerError'); // uita sessiunea
        }
        return $next($request);
    }
}
