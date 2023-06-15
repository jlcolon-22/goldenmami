<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RestaurantInformation;

class SettingController extends Controller
{
    //

    public function store(Request $request)
    {
        $y = json_decode($request->details,true);
        $x = (object)$y;
        $first = RestaurantInformation::first();
        $first->update([
            'res_name'=>$x->res_name,
            'res_email'=>$x->res_email,
            'res_number'=>$x->res_number,
            'res_fb'=>$x->res_fb,
            'res_twitter'=>$x->res_twitter,
            'res_instagram'=>$x->res_instagram,
        ]);
        if(!!$x->res_password)
        {

            User::where('id',Auth::guard('web')->user()->id)
                    ->update(['password'=>Hash::make($x->res_password)]);
        }
        if(!!$request->logo)
        {
            if(!!$first->logo)
            {
                unlink('storage/logo/'.$first->logo);
            }
            $filename = time().'-logo.'.$request->logo->extension();
            $first->update([
                'logo'=>$filename
            ]);
            $request->logo->storeAs('public/logo',$filename);
        }


    }

    public function show()
    {
        return response()->json(RestaurantInformation::first(), 200);
    }
}
