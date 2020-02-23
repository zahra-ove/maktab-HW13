<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = RouteServiceProvider::ROOT;   //after successful registration, redirect to root that is shopping website


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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'age' => ['nullable', 'numeric', 'max:300'],
            'gender_id' => ['required', 'numeric', 'max:3'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $newUser = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'age' => $data['age'],
            'gender_id' => $data['gender_id'],
            'password' => Hash::make($data['password']),
        ]);

        // $newUser = new User;
        // $newUser->name = $data['name'];
        // $newUser->username = $data['username'];
        // $newUser->email = $data['email'];
        // $newUser->age = $data['age'];
        // $newUser->gender_id = $data['gender_id'];
        // $newUser->password = Hash::make($data['password']);
        // $newUser->save();

        $userRole = Role::where('name', 'User')->first();
        $newUser->roles()->attach($userRole);

        return $newUser;
    }
}
