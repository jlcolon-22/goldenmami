<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Models\InventoryCategory;
use App\Http\Controllers\Controller;

class InventoryCategoryController extends Controller
{
    //

    public function all()
    {
        return response()->json(InventoryCategory::all(), 200);
    }
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|unique:inventory_categories']);
        InventoryCategory::create(['name'=>ucfirst($request->name)]);
        return response()->json(['success'=>true], 200);
    }
    public function update(Request $request,InventoryCategory $id)
    {
        $request->validate(['name'=>'required|unique:inventory_categories']);
        $id->update(['name'=>ucfirst($request->name)]);
        return response()->json(['success'=>true], 200);
    }
    public function destroy(InventoryCategory $id)
    {

        $id->delete();
        return response()->json(['success'=>true], 200);
    }
    public function index()
    {
        $categories = InventoryCategory::orderBy('id','desc')->paginate(7);
        return response()->json($categories, 200);
    }
}
