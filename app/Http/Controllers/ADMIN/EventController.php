<?php

namespace App\Http\Controllers\ADMIN;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'date'=>'required',
            'start'=>'required',
        ]);

        Event::create([
            'name'=>$request->name,
            'date'=>$request->date,
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
    }
    public function update(Request $request,Event $id)
    {
        $request->validate([
            'name'=>'required',
            'date'=>'required',
            'start'=>'required',
        ]);

        $id->update([
            'name'=>$request->name,
            'date'=>$request->date,
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
    }
    public function index()
    {
        $events = Event::orderBy('id','desc')->paginate(7);
        return response()->json($events, 200);
    }
    public function all()
    {
        $events = Event::orderBy('id','desc')->get();
        return response()->json(['events'=>$events], 200);
    }
    public function destroy(Event $id)
    {
        $id->delete();
    }

    public function addAttendance(Request $request)
    {

            $check = Attendance::where('employee_id',Auth::guard('employee')->user()->id)
                            ->where('created_at',Carbon::today()->toDateString())->first();
            if ($request->id == 0) {
                Attendance::create([
                    'employee_id'=>Auth::guard('employee')->user()->id,
                    'time_in'=>Carbon::now()->toDateTimeString(),
                    'branch'=>Auth::guard('employee')->user()->branch,
                    'created_at'=>Carbon::today()->toDateString(),
                ]);
            } else if($request->id == 1 && !!$check){
                    $check->update([
                    'time_out'=>Carbon::now()->toDateTimeString(),

                    ]);
            }




        return response()->json(Carbon::now()->toDateTimeString(), 200);
    }

    public function showAttendance()
    {
        $check = Attendance::where('employee_id',Auth::guard('employee')->user()->id)
                            ->where('created_at',Carbon::today()->toDateString())->first();
        return response()->json($check, 200);
    }

    public function allAttendance()
   {
        $attendance = Attendance::where('employee_id',Auth::guard('employee')->user()->id)
        ->orderBy('id','desc')->paginate(7);
        return response()->json($attendance, 200);
   }


   public function updateEmp(Request $request,Employee $id)
    {



           $id->update([
                'firstname'=>ucfirst($request->firstname),
                'lastname'=>ucfirst($request->lastname),
                'email'=>$request->email,
                'number'=>$request->number,


            ]);
            if(!!$request->password)
            {
                $id->update([
                    'password'=>Hash::make($request->password)
                ]);
            }

            if(!!$request->photo)
            {
                if(!!$id->photo)
                {
                    unlink('storage/employee/'.$id->photo);
                }
                $filename = time().'-employee.'.$request->photo->extension();
                $id->update([
                    'photo'=>$filename
                ]);
                $request->photo->storeAs('public/employee',$filename);
            }


        // return response()->json(['success'=>true], 200);
    }
}
