<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.show',compact('categories'));
    }
    public function creat(Request $request){
        Category::create([
            'name'=>$request->name,
            'colocation_id'=>$request->colocation_id
        ]);

        return redirect()->route('colocation.show', ['id' => $request->colocation_id]);
    }
    public function destroy(Request $request,$id){
        Category::find($id)->delete();
        return back();
    }
}
