<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        // if(Auth::check()){
        //     return to_route('admin.dashboard');
        // }
        return Inertia::render('auth/Login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // dd(Auth::user()->role);

        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            if(Auth::user()->role == 'admin')
            {
                return to_route('admin.dashboard');
            }else{
                return to_route('admin.dashboard');
            }
        }
       return back()->withErrors([
        'message' => "Username atau password salah"
       ]);
    }
}
