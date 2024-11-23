<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);
        $user->remember_token = $user->createToken('MyAppToken')->plainTextToken;
        $user->save();


        return redirect()->route('login');
        
        //return response()->json($response);
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([

            'email' => 'required|email',
            'password'=>'required|min:6|max:10'
        ]);
        if(Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();
            return redirect()->intended('/articles');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
        
}
