<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function handleSignin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'string|required',
            'password' => 'string|required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0]);
        }

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];


        if (Auth::attempt($data)) {
            return redirect()->route('dashboard.index')->with('success', 'Sign In Success.');
        } else {
            return back()->with('error', 'Incorrect username/password.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sign Out Success.');
    }
}
