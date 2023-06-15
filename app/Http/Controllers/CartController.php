<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $check = Cart::where('menu_id',$request->id)
                    ->where('customer_id',Auth::guard('customer')->user()->id)
                    ->first();
        if(!!$check)
        {
            $check->update([
                'qty'=>(int)$check->qty + 1
            ]);
        }else{
            Cart::create([
                'customer_id'=>Auth::guard('customer')->user()->id,
                'menu_id'=>$request->id,
                'qty'=>1
            ]);
        }

    }

    public function customerCart()
    {

        $all = Cart::with('customer_cart_menu')
                    ->where('customer_id',Auth::guard('customer')->user()->id)
                    ->orderBy('created_at','desc')
                    ->get();
        return response()->json($all, 200);
    }
    public function updateQty(Request $request)
    {
        $check = Cart::where('id',$request->id)
        ->where('customer_id',Auth::guard('customer')->user()->id)
        ->update(['qty'=>$request->qty]);
        return response()->json($check, 200);
    }
    public function destroy(Cart $id)
    {
        $id->delete();
    }
}
