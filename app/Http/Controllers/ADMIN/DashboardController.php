<?php

namespace App\Http\Controllers\ADMIN;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::get()->count();
        $employees = Employee::get()->count();
        $reservation = Reservation::get()->count();
        return response()->json(['customers'=>$customers,'employees'=>$employees,'reservations'=>$reservation]);
    }

    public function graph()
    {
        $reservation = Reservation::orderBy('date','asc')->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->date)->format('m'); // grouping by months
        });
        $resAmount = [];


        foreach ($reservation as $key => $value) {
            $resAmount[(int)$key] = count($value);
        }

        return response()->json($resAmount, 200);
    }
}
