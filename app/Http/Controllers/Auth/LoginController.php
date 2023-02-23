<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

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

    public function showLoginForm(){
        $branches = DB::table('branches')->get();
        return view('auth.login', compact('branches'));
    }
    
    public function authenticate(Request $request){
        return redirect()->intended();
    }

    function login(Request $req){
        $user= User::where(['email' => $req->username, 'branch_id' => $req->branch])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return redirect()->to('login')
                ->withErrors(['username' => 'Invalid Credentials']);
        } else {
            Auth::login($user);
            return redirect('/');
        }
    }
}
