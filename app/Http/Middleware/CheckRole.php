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
            if(Auth::user()->hasRole('Admin'))
            {

                // return redirect()->route('admin.mainPage');
                return $next($request);
            }elseif(Auth::user()->hasRole('User'))
            {
                $user = Auth::user();
                return redirect()->route('users.show', ['user'=>$user]);
            }

        }
        //if user is not logged in then redirect to login page
        else
        {
            return redirect('login');
        }




    }
}
