<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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


    protected function redirectTo()
    {
        if (auth()->user()->role === 'admin') {
            return '/home';
        } elseif (auth()->user()->role === 'kepsek') {
            return '/rekomendasi';
        }
        return '/login';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function store(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}