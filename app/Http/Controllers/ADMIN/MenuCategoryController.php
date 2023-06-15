<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:menu_categories'
        ]);
        MenuCategory::create([
            'name'=>$request->name
        ]);
        return response()->json(['success'=>'s'], 201);
    }
    public function fetch()
    {
        $categories = MenuCategory::orderBy('id','desc')->paginate(10);
        return response()->json($categories, 200);
    }
    public function destroy(MenuCategory $id)
    {
        $id->delete();
        return response()->json(['success'=>'deleted Successfully!'], 200);
    }
    public function update(Request $request,MenuCategory $id)
    {
        $id->update([
            'name'=>$request->name
        ]);
        return response()->json(['success'=>'Uodate Successfully'], 201);
    }
    public function allCategory()
    {
       $categories =  MenuCategory::all();
       return response()->json($categories, 200);
    }
}
