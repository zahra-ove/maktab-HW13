<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        // if(Auth::check())
        //     return Auth::user();
        // else
        //     return "you are not logged in";




        //check if user is logged in
        if(Auth::check())
        {
            //if logged in user has Admin role then redirect to admin panel
            if(Auth::user()->hasRole('Admin'))
            {

                // return redirect()->route('admin.mainPage');
                return $next($request);

            }
            //if logged in user has not Admin role and is only user, redirect to user profile page
            elseif(Auth::user()->hasRole('User'))
            {
                $user = Auth::user();
                return redirect()->route('profile', ['user'=>$user]);
            }

        }
        //if user is not logged in then redirect to login page
        else
        {
            return redirect('login');
        }




    }
}
