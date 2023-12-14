<?php

namespace App\Http\Controllers;

use App\Mail\RefundEmail;
use App\Models\Cart;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationEmail;
use App\Models\Refund;
use App\Models\ReservationOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Luigel\Paymongo\Facades\Paymongo;

class ReservationController extends Controller
{
    public function store(Request $request)
    {

        $user = Auth::guard('customer')->user();
        $request->validate([
            'time'=>'required',
            'date'=>'required',
            'order'=>'required',
            'guest'=>'required',
            'phone_number'=>'required|digits:10|numeric',
            'branch'=>'required',
        ]);

        if(Carbon::now()->format('Y-m-d') == $request->date)
        {

            if(((int)$request->time['hours'] - (int)Carbon::now()->format('h')) < 0)
            {
                return response()->json('2 hours',233);
            }else
            {

                if(((int)$request->time['hours'] - (int)Carbon::now()->format('h')) == 1 || ((int)$request->time['hours'] - (int)Carbon::now()->format('h')) == 2)
                {
                    return response()->json('2 hours',233);
                }

            }

        }



        $totals = Cart::with('customer_cart_menu')->where('customer_id',$user->id)->get();
        if(count($totals) == 0)
        {
            return response()->json(['errors'], 205);
        }
        $total = 0;

        foreach($totals as $value)
        {

           $total += (int)$value->customer_cart_menu->price*(int)$value->qty;
        }
        $percentage = (50 / 100) * $total;
        if((int)$total < 500)
        {
            return response()->json(['min amount'], 207);
        }


        $reserve = Reservation::create([
            'time'=>$request->time['hours'].':'.$request->time['minutes'],
            'date'=>$request->date,
            'number'=>$request->phone_number,
            'guest'=>$request->guest,
            'branch'=>$request->branch,
            'payment'=>$total,
            'customer_id'=>$user->id,
        ]);
        foreach($totals as $value)
        {
            ReservationOrder::create([
                'reservation_id'=>$reserve->id,
                'menu_id'=>$value->customer_cart_menu->id,
                'qty'=>$value->qty
            ]);

        }

        $percentage = (50 / 100) * $total;
        $amount = (int)$percentage."00";

        $checkout = Paymongo::checkout()->create([
            'cancel_url' =>  url()->previous(),
            'billing' => [
                'name' => $user->nickname,
                'email' =>$user->email,
                'phone' => $reserve->number,
            ],
            'description' => 'Reservation Fee',
            'line_items' => [
                [
                    'amount' =>(int)$amount,
                    'currency' => 'PHP',
                    'name' => 'Down payment',
                    'quantity' => 1
                ]
            ],
            'payment_method_types' => [
                'gcash',

            ],
            'success_url' => 'http://127.0.0.1:8000/payment/success/'.$reserve->id,
            'statement_descriptor' => 'Laravel Paymongo Library',
            'metadata' => [
                'Key' => 'Value'
            ]
        ]);
        $reserve->update(['cs_id'=>$checkout->id]);

        return response()->json($checkout->checkout_url);
    }

    public function paymentSuccess(Reservation $id)
    {
        // $id->update(['status'=>2]);
        $checkout = Paymongo::checkout()->find($id->cs_id);

        if(!!$checkout->payments)
        {
            $status = $checkout->payments[0]['attributes']['status'];
            $id->update(['payment_status'=>$status]);
        }
        try {
            $data = [
                'subject'=>'Golden Mami House Reservation Message',
                'body'=>"The Golden Mami House is glad that you are one of our customers. Let us know if you have any questions or clarification regarding your order. Thank you and God Bless."
            ];
            Mail::to(Auth::guard('customer')->user()->email)->send(new ReservationEmail($data));

        } catch (Exeption $th) {

        }
        return view('auth.success_payment');
    }

    public function reservation_list()
    {
        $lists = Reservation::with('order_item','order_items')->where('customer_id',Auth::guard('customer')->user()->id)->orderBy('id','desc')->paginate(6);

        return response()->json($lists, 200);
    }


    public function refundStore(Request $request)
    {
        $refund = Refund::query()
                ->create([
                    'reason'=>$request->reason,
                    'customer_id'=>Auth::guard('customer')->user()->id
                ]);

        if(!!$request->receipt)
        {
            $filename = time().'-refund.'.$request->receipt->extension();

            $refund->update([
                'receipt'=>$filename
            ]);
            $request->receipt->storeAs('public/refund', $filename);
        }
        $data = [
            'body'=> 'We have received your request. We will check it first, and you can just wait for our response here in the email.',
            'subject'=>'Golden Mami House Vefication',
        ];
        Mail::to(Auth::guard('customer')->user()->email)->send(new RefundEmail($data));
    }
}
