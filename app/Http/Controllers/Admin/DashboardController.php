<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Depences;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $colocation_members = DB::select('select colocations.name ,count(memberships.user_id) as colo_users , colocations.status from memberships JOIN colocations on colocations.id = memberships.colocation_id GROUP BY colocations.name ,colocations.status ORDER by colo_users DESC');
        // dd($colocation_members);
        $banned_users= User::where('is_banned',true)->count();
        $total_depences=Depences::sum('amount');
        $active_colocations=Colocation::where('status','active')->count();
        $total_users=User::count();
        $users = User::paginate(5);
        return view('admin.dashboard',compact('users','total_users','active_colocations','total_depences','banned_users','colocation_members'));
    }
    public function ban($id){
        User::find($id)->update(['is_banned'=>true]);
        return redirect()->route('admin.dashboard');
    }
    public function unban($id){
        User::find($id)->update(['is_banned'=>false]);;
        return redirect()->route('admin.dashboard');
    }
}
