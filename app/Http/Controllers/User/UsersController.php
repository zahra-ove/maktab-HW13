<!-- <?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('user.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'username' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|confirmed|min:8',
    //         'age' => 'nullable|numeric',
    //         'gender_id' => 'required|numeric'
    //     ]);

    //     $newUser = new User();

    //     $newUser->name = $request->post('name');
    //     $newUser->username = $request->post('username');
    //     $newUser->email = $request->post('email');
    //     $newUser->password = Hash::make($request->post('password'));
    //     $newUser->age = $request->post('age');
    //     $newUser->gender_id = $request->post('gender_id');
    //     $newUser->save();

    //     //set default role for this user as Generic user
    //     $userRole = Role::where('name', 'User')->first();
    //     $newUser->roles()->attach($userRole);

    //     return redirect('/')->with('successRegister', 'کاربر گرامی، ثبت نام شما با موفقیت انجام شد.');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.profile')->with('user', $user);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
} -->
