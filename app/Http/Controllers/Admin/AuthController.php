<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function Login(Request $request)
    {

        if (!Auth::guard('admin')->check()) {
            return view('admin.auth.login');
        }else{
            return redirect('/admin/dashboard');
        }

    }

    public function LoginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6|max:12',
        ]); 

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

         // Invalid credentials
         return back()->with('error', 'Invalid login credentials');
    }
    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
