<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $check_infos = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($check_infos) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if(Auth::user()->role == 'membre') {
                return redirect()->route('welcome.dashboard');
            } else {
                return redirect()->route('home');
            }
        }
        else {
            return redirect()->route('login')->with('error','Email or Password are invalid');
        }
    }
}
