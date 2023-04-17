<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Session\Store;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request) 
    {   
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $plislogin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($plislogin)) {
            # code...
            $request->session()->regenerate();
            Auth::loginUsingId(Auth::id());

            return redirect()->intended('/');
        } else {
            # code...
            return back()->withErrors([
                'username'=> 'User ID atau Password anda Salah!',
            ]);
        }
        
    }

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}
}