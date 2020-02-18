<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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

//I commented this line
    // protected $redirectTo = RouteServiceProvider::ROOT;
//I added this method instead of above line that is $redirectTo property. this way is fully described in this link: https://codeburst.io/learn-how-to-redirect-authenticated-users-to-corresponding-path-in-laravel-dd613e2f9e3
    public function redirectTo()
    {
        //get authenticated user object
        $user = Auth::user();

        //if user has Admin role then redirect to admin panel otherwise redirect to profile page
        if($user->hasRole('Admin'))
        {
            return '/admin';
        }
        else
        {
            return '/profile';
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
