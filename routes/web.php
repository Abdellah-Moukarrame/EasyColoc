<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'register'])->name('register.create');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.create');



/////admin routing

Route::get('/admin',[DashboardController::class,'index'])->name('admin.dashboard');

//// welcoming dashboard

Route::get('/welcome',[WelcomeDashboardController::class,'index'])->name('welcome.dashboard');
