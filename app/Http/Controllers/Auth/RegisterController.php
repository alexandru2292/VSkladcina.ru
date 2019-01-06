<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = '/';

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
    protected function validator(array  $data)
    {


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $data = $request->all();
        if($data){
            $rules = [
                'name' => ['required', 'string', 'max:255', 'min:2'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ];
            $messages = [
                'password.required'       => 'Пароль является обязательным для заполнения!',
                'email.required'       => 'E-mail является обязательным для заполнения!',
                'max'      => 'Поле  :attribute  должно содержать максимум :max  символов!',
                'email.unique' => 'Адрес '. $data['email'] .' уже зарегистрирован!',
                'password.confirmed' => 'Подтверждение пароля не совпадает!',
                'password.min' => 'Пароль должен содержать не менее :min символов!',
                'email.email' => 'Адрес должен быть действительным адресом электронной почты!',
                'name.min' => 'Имя должно содержать не менее :min символов.'

            ];
            $validator = Validator::make($data,$rules , $messages);

            if($validator->fails()){
                return redirect()->route('index')->withErrors($validator)->withInput();
            }
        }
        /* End VALIDATE platform */
        $result =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        if(is_array($result) && !empty($result['error'])){
            return back()->with(['status' => 'Пользватель не зарегистрирован!']);
        }
        return redirect()->route('index')->with(['status' => 'Пользватель зарегистрирован!']);

    }
}
