<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Depences;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $colocation_members = Colocation::join('');
        $banned_users= User::where('is_banned',true)->count();
        $total_depences=Depences::sum('amount');
        $active_colocations=Colocation::where('status','active')->count();
        $total_users=User::count();
        $users = User::paginate(5);
        return view('admin.dashboard',compact('users','total_users','active_colocations','total_depences','banned_users'));
    }
}
