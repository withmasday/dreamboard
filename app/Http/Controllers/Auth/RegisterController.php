<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function handleSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'string|required|max:255',
            'username' => 'string|required|unique:users',
            'password' => 'string|required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0]);
        }


        $data = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ];


        if (User::create($data)) {
            return redirect()->route('login')->with('success', 'Sign Up Success.');
        } else {
            return back()->with('error', 'Something wrong...');
        }
    }
}
