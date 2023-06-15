<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationEmail;
use App\Models\ReservationOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AdminReservationController extends Controller
{
    public function index()
    {
        $lists = Reservation::with('order_item','order_items','customer_info')->orderBy('id','desc')->paginate(6);
        return response()->json($lists, 200);
    }
    public function send()
    {

        try {
            $data = [
                'subject'=>'Golden Mami House Reservation Message',
                'body'=>"hello im deku"
            ];
            Mail::to('xxdekuxxweak@gmail.com')->send(new ReservationEmail($data));
            return response()->json(['tree'], 200);
        } catch (Exeption $th) {
            return response()->json(['false'], 200);
        }
    }

    public function approved(Reservation $id,Request $request)
    {
        $customer = Customer::where('id',$id->customer_id)->first();
        if($request->data == 1)
        {
            $id->update(['status'=>1]);
            try {
                $data = [
                    'subject'=>'Reservation Approved',
                    'body'=>"Thank you for choosing Golden Mami House. Let us know if you have any questions or clarifications with your order. Thank you and God Bless.
                    "
                ];
                Mail::to($customer->email)->send(new ReservationEmail($data));

            } catch (Exeption $th) {
                return response()->json(['false'], 200);
            }
        }else{
            $id->update(['status'=>2]);
            try {
                $data = [
                    'subject'=>'Reservation Approved',
                    'body'=>"Dear customer, due to unforeseen circumstances, we decided to cancel your reservation. We hope to see you soon.
                    "
                ];
                Mail::to($customer->email)->send(new ReservationEmail($data));

            } catch (Exeption $th) {
                return response()->json(['false'], 200);
            }
        }
    }
    public function destroy(Reservation $id)
    {
        ReservationOrder::where('reservation_id',$id->id)->delete();
        $id->delete();
    }
    public function search(Request $request)
    {
        $lists = Reservation::with('order_item','order_items','customer_info')->where('date','LIKE','%'.$request->s.'%')->orderBy('id','desc')->paginate(6);
        return response()->json($lists, 200);
    }
}
