<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Colocation\ColocationController;
use App\Http\Controllers\Depences\DepencesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Invitation\InvitationController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\Membership\MembershipController;
use App\Http\Controllers\WelcomeDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ColocationMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register.create')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.create')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

///// admin routing
Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/banUser/{id}', [DashboardController::class, 'ban'])->name('user.ban');
    Route::post('/unbanUser/{id}', [DashboardController::class, 'unban'])->name('user.unban');
});

//// authenticated routes
Route::middleware('auth')->group(function () {

    // welcome dashboard
    Route::get('/welcome', [WelcomeDashboardController::class, 'index'])->name('welcome.dashboard');
    Route::post('/welcome', [ColocationController::class, 'create'])->name('welcome.create_colocation');

    // colocations
    Route::get('/colocation/{id}', [ColocationController::class, 'index'])->name('colocation.show')->middleware(ColocationMiddleware::class);

    // categories
    Route::post('/category/add', [CategoryController::class, 'creat'])->name('category');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // invitations
    Route::post('/invitation/add', [InvitationController::class, 'create'])->name('invitation.add');
    Route::post('/send_invitation', [MailController::class, 'index'])->name('send_invitation');
    Route::get('/accept_invitation', [InvitationController::class, 'accept'])->name('acceptInvit');

    // depences
    Route::post('/despence/add', [DepencesController::class, 'create'])->name('depences.add');
    Route::get('/depences/{id}', [DepencesController::class, 'index'])->name('depences.index')->middleware(ColocationMiddleware::class);

    // statements
    Route::patch('/statement/{id}/paid', [DepencesController::class, 'markPaid'])->name('statement.paid');

    // membership
    Route::post('/membership/leave', [MembershipController::class, 'quitter'])->name('membership.quitter');
});
