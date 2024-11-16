<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin() {
        return view('auth.signin');
    }

    public function signup() {
        return view('auth.signup');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:\App\Models\User',
            'password' => 'required|min:6|max:10'
        ]);
        $response = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => request('password')
        ];
        return response()->json($response);
    }
}
