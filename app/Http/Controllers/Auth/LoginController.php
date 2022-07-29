<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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


    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
        if (isset($request->remember) && $request->remember == 'Yes') {
            setcookie("USERNAME", $request->name, time() + 86400, "/");
            setcookie("PASSWORD", $request->password, time() + 86400, "/");
        } else {
            setcookie("USERNAME", '', time() - 1000, "/");
            setcookie("PASSWORD", '', time() - 1000, "/");
        }

        $userData = User::where("name", "=", $request->name)->first();

        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password']))) {
            if (!empty($userData) && $userData->user_type != NULL) {
                return redirect()->route('home')
                ->with('success', 'Logged in successfully.');
            } else {
                Auth::logout();
                 return redirect()->route('login')
                    ->with('error', 'Please contact to admin for set your account type.');
            }
        } else {
            
            return redirect()->route('login')
                ->with('error', 'User name and Password are incorrect.!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')
        ->with('success', 'Logged out successfully.');
    }
}
