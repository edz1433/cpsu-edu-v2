<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function userCreate(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $validatedData = $validator->validated();
    
        if ($request->filled('password') && $request->input('password') !== $request->input('password_confirmation')) {
            return redirect()->back()->withErrors(['password_confirmation' => 'The passwords do not match.'])->withInput();
        }        
    
        $validatedData['password'] = Hash::make($validatedData['password']);
    
        $user = User::create($validatedData);
    
        return redirect()->back()->with('success', 'User created successfully');
    }
}
