<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Customer;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendMenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::with('category_menu')->where('category_id','LIKE','%'.$request->search.'%')->orderBy('id','desc')->paginate(7);

        return response()->json($menus, 200);
    }

    public function categories()
    {
        $categories = MenuCategory::orderBy('id','desc')->get();

        return response()->json($categories, 200);
    }
    public function dashboardMenu()
    {
        $menus = Menu::limit(6)->get();
        return response()->json($menus, 200);
    }

    public function my()
    {
        return response()->json(Auth::guard('customer')->user(), 200);
    }

    public function myUpdate(Request $request)
    {

        $user = Customer::where('id',Auth::guard('customer')->user()->id)
                        ->first();
        $user->update([
            'nickname'=>$request->nickname,
            'email'=>$request->email,
            'number'=>$request->number,
            'address'=>$request->address == 'null' ? '' : $request->address,
        ]);

        if(!!$request->password)
        {
            $user->update(['password'=>Hash::make($request->password)]);
        }
        if(!!$request->photo)
        {
            if(!!$user->photo)
            {
                unlink('storage/customer/'.$user->photo);
            }

            $filename = time().'-customer.'.$request->photo->extension();
            $user->update(['photo'=>$filename]);
            $request->photo->storeAs('public/customer',$filename);

        }
    }
}
