<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request) // (email;password) ? auth->user = null
    {
        // $collocation = Colocation::find($id);
        $check_infos = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($check_infos) {
            $membership = Membership::where(['user_id' => auth()->user()->id])->whereHas('colocation', function ($query) {
                $query->where('status', 'active');
            })->first();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->role == 'membre') {
                if ($membership) {
                    return redirect()->route('colocation.show',['{id}', $membership->colocation_id]);
                }
                return redirect()->route('welcome.dashboard');
            }
            else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email or Password are invalid');
        }
    }
}
