<?php

namespace App\Http\Controllers\Depences;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Depences;
use Illuminate\Http\Request;

class DepencesController extends Controller
{
    public function index(){
        $despences = Depences::all();
        return view('depences.index',compact('despences'));
    }
    public function create(Request $request){
        // dd($request->all());
        Depences::create([
            'name'=>$request->name,
            'amount'=>$request->amount,
            'category_id'=>$request->category_id,
            'user_id'=>$request->paid_by,
            'colocation_id'=>$request->colocation_id
        ]);

        return redirect()->route('colocation.show', ['id' => $request->colocation_id]);
    }
}
