<?php

namespace App\Http\Controllers\API;

use App\Models\Refund;
use App\Mail\RefundEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        return view("admin.refund.index");
    }

    public function getRefund(Request $request)
    {
        $refunds = Refund::with('userInfo')->orderBy('id','desc')->paginate(10);
        return response()->json($refunds);
    }

    public function updated($id,$type)
    {

        $refund = Refund::with('userInfo')->where('id',$id)->first();
            $refund->update([
                'status' =>$type
            ]);

            if($type == 1)
            {
                $data = [
                    'body'=> 'Refund request approved. ',
                    'subject'=>'Approved refund request- Golden Mami House',
                ];
            }else{
                $data = [
                    'body'=> 'Refund request failed',
                    'subject'=>'Faild refund request- Golden Mami House',
                ];
            }


            Mail::to($refund->userInfo->email)->send(new RefundEmail($data));

    }
}
