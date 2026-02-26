<?php

namespace App\Http\Controllers\Colocation;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index($id)
    {

        $collocation = Colocation::find($id);
        $categories = Category::where('colocation_id', $collocation->id)->get();
        $owner = Membership::where('colocation_id', $collocation->id)->where('type', 'owner')->first()->user;
        // dd($owner);
        return view('colocations.show', compact('categories', 'collocation', 'owner'));
    }
    public function create(Request $request)
    {

        if (!Membership::where(['user_id' => auth()->user()->id, 'type' => 'owner'])->whereHas('colocation', function ($query) {
            $query->where('status', 'active');
        })->exists())
        {
            $colocation = Colocation::create([
                'name' => $request->name,
                'status' => 'active',
            ]);
            Membership::create([
                'user_id' => auth()->user()->id,
                'colocation_id' => $colocation->id,
                'type' => 'owner',
                'status' => 'complete',
                'solde' => 0,
                'joined_at' => now(),
                'left_at' => null,
            ]);
            return redirect()->route('colocation.show', ['id' => $colocation->id]);
        }
        else {
            return redirect()->back()->withErrors(['message'=>'u have already an active colocation']);
        }
    }
}
