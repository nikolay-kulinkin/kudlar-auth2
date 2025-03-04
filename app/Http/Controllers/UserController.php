<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>['required','max:255'],
            'email'=>['required','email','max:255','unique:users'],
            'password'=>['required']
        ]);
        User::create($validated);
        return redirect()->route('login')->with('success','Success registration');
    }

    public function loginForm()
    {
        return view('users.login-form');
    }

    public function loginAuth(Request $request)
    {
        $validated=$request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]); 
        
        if(Auth::attempt($validated)){
            return redirect()->intended('/')->with('success','Success login');
        }
        return back()->withErrors([
            'email'=>'Wrong email or password'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
