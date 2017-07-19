<?php

namespace SON\Http\Controllers\Auth;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use SON\Models\Admin;

class LoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(),'password');
        $usernameKey = $this->usernameKey();
        $data[$usernameKey] = $data[$this->username()];
        $data['userable_type'] = Admin::class;
        unset($data[$this->username()]);
        return $data;
    }

    protected function usernameKey(){
        $email = \Request::get($this->username());
        $validator = \Validator::make([
            'email' => $email
        ],['email' => 'email']);
        return $validator->fails() ? 'enrolment': 'email';
    }

    public function username()
    {
        return 'username';
    }


}
