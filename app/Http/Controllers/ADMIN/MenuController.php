<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:menus',
            'price'=>'required',
            'status'=>'required',

            'photo'=>'required',
            'category'=>'required',
        ]);
        $filename = time().'-menu.'.$request->photo->extension();
        Menu::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'status'=>$request->status,
            'description'=>$request->description,
            'category_id'=>$request->category,
            'photo'=>$filename
        ]);
        $request->photo->storeAs('public/menu',$filename);
        return response()->json($request->all(), 200);
    }

    public function index()
    {
        $menus = Menu::with('category_menu')->orderBy('id','desc')->paginate(5);

        return response()->json($menus, 200);
    }

    public function search(Request $request)
    {
        $menus = Menu::with('category_menu')->where('name','LIKE','%'.$request->search.'%')->paginate(5);
        return response()->json($menus, 200);
    }

    public function update(Request $request,Menu $id)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'status'=>'required',
            'category'=>'required',
        ]);
        $x = $id->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'status'=>$request->status,
            'description'=>$request->description,
            'category_id'=>$request->category,
        ]);
        if($request->photo != null)
        {
           unlink('storage/menu/'.$id->photo);
            $filename = time().'-menu.'.$request->photo->extension();
            $id->update([
                'photo'=>$filename
            ]);
            $request->photo->storeAs('public/menu',$filename);
        }
        return response()->json($request->all(), 200);
    }

    public function destroy(Menu $id)
    {
        unlink('storage/menu/'.$id->photo);
        $id->delete();
        return response()->json(['success'=>true]);
    }
}
