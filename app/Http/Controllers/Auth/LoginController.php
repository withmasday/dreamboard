<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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

    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $email = $user->getEmail();
        $username = str_replace("@google.com", "", $email);

        $fuser = User::where('username', '=', $username)->first();

        if ($fuser) {
            Auth::login($fuser);
            return redirect()->route('dashboard.index')->with('success', 'Sign In Success.');
        }

        $data = [
            'fullname' => $user->getName(),
            'username' => $username,
            'password' => bcrypt(Str::uuid())
        ];

        User::create($data);
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard.index')->with('success', 'Sign In Success.');
        } else {
            return back()->with('error', 'Incorrect username/password.');
        }
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
