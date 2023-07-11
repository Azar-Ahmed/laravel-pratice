<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }

    public function LoginSubmit(Request $request){
       
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6|max:12',
        ]); 

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Incorrect User Email or Password');
    }

    public function Register(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('admin.auth.register');
    }

    public function RegisterSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12',
        ]); 

        $user = User::where('email', $request->email)->first();
        if($user){
            return back()->with('error', 'Email already in use');
        }
        
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => 0,
        ]);

        Auth::login($user); // Login User  

        return redirect()->route('login')->with('success', 'User Registered Successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }


   
}
