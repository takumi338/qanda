<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        \Session::flash('flash_message','ログインしました。');
        return '/allposts';
    }

    public function guestLogin()
    {
        $email = 'guest@guest.jp';
        $password = 'guestguest';

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            \Session::flash('flash_message','ログインしました。');
            return redirect()->route('posts.index');
        }

        return redirect(route('posts.index'));
    }

    protected function loggedOut(Request $request)
    {
        \Session::flash('flash_message','ログアウトしました。');
         return redirect(route('home'));
    }
}
