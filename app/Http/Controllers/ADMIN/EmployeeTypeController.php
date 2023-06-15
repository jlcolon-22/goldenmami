<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\EmployeeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeTypeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|unique:employee_types']);
        EmployeeType::create([
            'name'=>$request->name
        ]);
        return response()->json(['success'=>true], 200);
    }
    public function update(Request $request,EmployeeType $id)
    {
        $request->validate(['name'=>'required']);
        $id->update([
            'name'=>$request->name
        ]);
        return response()->json(['success'=>true], 200);
    }
    public function allType()
    {
        return response()->json(EmployeeType::all(),200);
    }

    public function index(){
        $types = EmployeeType::orderBy('id','desc')->paginate(7);
        return response()->json($types, 200);
    }
    public function destroy(EmployeeType $id)
    {
        $id->delete();
        return response()->json(['success'=>true], 200);
    }
}
