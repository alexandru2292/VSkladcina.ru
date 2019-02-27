<?php

namespace App\Http\Controllers\Auth;

use App\Role_user;
use App\User;
use App\Http\Controllers\Controller;
//use http\Env\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator  = Validator::make($data, [
            'name' => 'required|string|max:255',
//            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails()){
            session(['registerError' => 1] );
            /**
             * Delete login session
             */
            if(session('loginError')){
                \Session::forget('loginError'); // uita sessiunea
            }

        }

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        /**
         * Delete login session
         */
        if(session('loginError')){
            \Session::forget('loginError'); // uita sessiunea
        }

        /**
         * Register new user
         */
        $newUser = User::create([
            'name' => $data['name'],
//            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $role_user = new Role_user();
        $role_user->user_id = $newUser->id;
        $role_user->role_id = 3;
        $role_user->save();
        return $newUser;
    }
}
