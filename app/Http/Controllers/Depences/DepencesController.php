<?php

namespace App\Http\Controllers\Depences;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Depences;
use App\Models\Membership;
use App\Models\Statement;
use Illuminate\Http\Request;

class DepencesController extends Controller
{
    public function index($id)
    {
        $collocation = Colocation::find($id);
        $owner = Membership::where('colocation_id', $collocation->id)->where('type', 'owner')->first()->user;
        $members = Membership::where('colocation_id',$collocation->id)->where('type','member')->get();
        $depences = Depences::where('colocation_id', $collocation->id)->get();
        $categories = Category::where('colocation_id', $collocation->id)->get();
        $membersCount = Membership::where('colocation_id', $collocation->id)->where('status', 'complete')->count();

        return view('depences.index', compact('depences', 'owner', 'collocation','membersCount','categories','members'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $depence = Depences::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'user_id' => $request->paid_by,
            'colocation_id' => $request->colocation_id
        ]);
        $members = Membership::where([
            'colocation_id' => $request->colocation_id,
            'status' => 'complete'
        ])->get();

        $share = $depence->amount / $members->count();

        foreach ($members as $member) {
            Statement::create([
                'user_id' => $member->user_id,
                'receiver_id' => $depence->user_id,
                'colocation_id' => $request->colocation_id,
                'depence_id' => $depence->id,
                'amount_to_pay' => $share,
                'status' => ($member->user_id == $depence->user_id) ? 'paid' : 'unpaid',
            ]);
        }


        return redirect()->route('colocation.show', ['id' => $request->colocation_id]);
    }
    public function markPaid($id)
    {
        Statement::find($id)->update(['status' => 'paid']);
        return back();
    }
}
