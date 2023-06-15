<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ReservationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantInformation;

class ContactController extends Controller
{
    public function store(Request $request)
    {

        $info = RestaurantInformation::first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11|numeric',
            'message' => 'required'
        ]);
        $data = Contact::create($request->all());
        try {
            $data = [
                'subject'=>'Contact Us',
                'body'=>
                 "Name: {$request->name}<br>"
                . "Email:{$request->email}<br>"
                . "Phone Number:{$request->phone}<br>"
                . "Message: {$request->message}"
            ];
            Mail::to($info->res_email)->send(new ReservationEmail($data));

        } catch (Exeption $th) {

        }

    }
}
