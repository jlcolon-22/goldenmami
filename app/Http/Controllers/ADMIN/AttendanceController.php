<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        $all = Attendance::with('attendance_employee')->orderBy('id','desc')->paginate(7);

        return response()->json($all, 200);
    }

    public function search(Request $request)
    {
        $all = Attendance::with('attendance_employee')->where('created_at','LIKE','%'.$request->s.'%')->orderBy('id','desc')->paginate(7);

        return response()->json($all, 200);
    }

    public function branch(Request $request)
    {
        $all = Attendance::with('attendance_employee')->where('branch',$request->branch)->orderBy('id','desc')->paginate(7);

        return response()->json($all, 200);
    }
}
