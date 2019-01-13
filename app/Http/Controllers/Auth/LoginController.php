<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockController;
use App\Repositories\StockRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;
use Validator;
use Redirect;


class LoginController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';


//    public function authenticate(Request $request)
//    {
//        $email = $request->email;
//        dd($email);
//        if (Auth::attempt(['email' => $email, 'password' => $password]))
//        {
//            return redirect()->intended('dashboard');
//        }
//    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->template = config('settings.theme').'.index';
    }
    public function showLoginForm(StockRepository $stockRep)
    {
        $stocks = $stockRep->getStocks();
        $this->content = view(config('settings.theme').'.contentIndex')->with(['stocks' =>  $stocks])->render();
        return $this->renderOutput();
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
    /**
     * Login user
     * @param array $data - input name, email , password
     */
//    public function login(Request $request){
//        dd('Da');
//        /**
//         * Get logged user
//         */
//        $user = User::where('email', $request->email)->first();
//
//        $data = $request->all();
//        if($data){
//            $rules = [
//                'name' => ['required', 'string', 'max:255', 'min:2'],
//                'email' => ['required', 'string', 'email', 'max:255'],
//                'password' => ['required', 'string', 'min:6'],
//            ];
//            $messages = [
//                'password.required'       => 'Пароль является обязательным для заполнения',
//                'email.required'       => 'E-mail является обязательным для заполнения',
//                'max'      => 'Поле  :attribute  должно содержать максимум :max  символов',
//                'email.unique' => 'Адрес '. $data['email'] .' уже зарегистрирован',
//                'password.min' => 'Пароль должен содержать не менее :min символов',
//                'email.email' => 'Адрес должен быть действительным адресом электронной почты',
//                'name.min' => 'Имя должно содержать не менее :min символов'
//            ];
//            $validator = Validator::make($data,$rules , $messages);
//            if($validator->fails()){
////                $validator->errors()->messages->errorLogging = "DA";
////                dd($validator->errors());
//                $messages = $validator->messages();
//
//                $messages->get('name') ?  $name = $messages->first('name') : $name = false;
//                $messages->get('email') ? $email = $messages->first('email') : $email = false;
//                $messages->get('password') ? $password = $messages->first('password') : $password = false;
//
//                $errors['name']= $name;
//                $errors['email'] = $email;
//                $errors['password'] = $password;
//
//                return back()->with('status',$errors);
//            }
//        }
//
//
//        if(Hash::check($request->password, $user->password) && ($user->name == $request->name)){
//            session(['loggedInUser' => $user->id] );
//            return redirect()->route('profileIndex')->with(['status' => 'Пользватель залогинен!']);
//        }else{
//            if($user->name != $request->name){
//                $errors['name'] = "Неправильное имя";
//            }
//            if(!Hash::check($request->password, $user->password)){
//                $errors['password'] = 'Неправильно указан логин и/или пароль';
//            }
//            return back()->with('status',$errors);
//        }
//    }
}
