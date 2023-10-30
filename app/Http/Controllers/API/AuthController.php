<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantInformation;

class AuthController extends Controller
{
    public function verify(Request $request)
    {
        $user = Customer::where('id',$request->key)->update(['email_validate'=>1]);
        $info = RestaurantInformation::first();
        $request->session()->put('success', 'value');
         return redirect('/login');
    }
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8',
        ]);
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return response()->json(['success'=>true], 200);
        }else if(Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return response()->json(['success'=>true], 202);
        }else if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if(Auth::guard('customer')->user()->email_validate == 0)
            {
                Auth::guard('customer')->logout();
                return response()->json(['success'=>true], 205);
            }
            $request->session()->regenerate();
            return response()->json(['success'=>true], 201);
        }else{
            return response()->json(['error'=>'wrong credentials!'], 203);
        }


    }

    public function register(Request $request)
    {
        $request->validate([
            'nickname'=>'required',
            'email'=>'required|unique:customers|email',
            'number'=>'required|digits:10|numeric',
            'password'=>'required|min:8',
        ]);
        $create = Customer::create([
            'nickname'=>$request->nickname,
            'email'=>$request->email,
            'number'=>$request->number,
            'password'=>Hash::make($request->password),
        ]);
        $data = [
            'link'=> env('MAIN_DOMAIN').'/auth/verify-email?key='.$create->id,
            'subject'=>'Golden Mami House Vefication',
        ];
        Mail::to($request->email)->send(new VerificationEmail($data));
        return view('auth.success');
        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return response()->json(['success'=>true], 200);
        }else{
            return response()->json(['error'=>'wrong credentials!'], 203);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'nickname'=>'required',
            'email'=>'required|unique:customers',
            'number'=>'required|min:11|max:11',
            'address'=>'required',
            'email_validate'=>'required',
            'password'=>'required|min:8',
        ]);
        Customer::create([
            'nickname'=>$request->nickname,
            'email'=>$request->email,
            'number'=>$request->number,
            'address'=>$request->address,
            'email_validate'=>$request->email_validate,
            'password'=>Hash::make($request->password),
        ]);
    }
}
