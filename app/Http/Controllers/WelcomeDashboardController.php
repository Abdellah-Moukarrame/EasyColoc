<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeDashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }
}
