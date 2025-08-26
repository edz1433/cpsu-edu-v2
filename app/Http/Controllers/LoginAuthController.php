<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAuthController extends Controller
{
    public function getLogin()
    {
        return view('webadmin.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];
    
        if (auth()->attempt($credentials)) {
            return redirect()->route('admin-dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
