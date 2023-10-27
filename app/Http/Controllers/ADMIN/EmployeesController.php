<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function store(Request $request)
    {


        // $x = json_decode($request->details,true);
        $y = json_decode(($request->details),true);
       $x = (object)$y;

        $rules = [
            'firstname'=>'required',
            'lastname'=>'required',
            'age'=>'required',
            'type'=>'required',
            'gender'=>'required',
            'password'=>'required',
            'branch'=>'required',
        ];
        $validator = Validator::make($y,$rules);
        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 244);
        }else{

           $create = Employee::create([
                'firstname'=>ucfirst($x->firstname),
                'lastname'=>ucfirst($x->lastname),
                'email'=>$x->email,
                'number'=>$x->number,
                'gender'=>$x->gender,
                'age'=>$x->age,
                'branch'=>$x->branch,
                'address'=>$x->address,
                'type_id'=>$x->type,
                'password'=>Hash::make($x->password),
            ]);
            // return $request->photo;
            if(!!$request->photo)
            {

                $filename = time().'-employee.'.$request->photo->extension();
                $create->update([
                    'photo'=>$filename
                ]);
                $request->photo->storeAs('public/employee',$filename);
            }
        }
        return response()->json(['success'=>true], 200);
    }

    public function index()
    {
        $employees = Employee::with('employee_type')->orderBy('id','desc')->paginate(7);
        return response()->json($employees, 200);
    }
    public function update(Request $request,Employee $id)
    {


        $x = json_decode($request->details,true);
        $y = json_decode(($request->details),true);
       $x = (object)$y;



           $id->update([
                'firstname'=>ucfirst($x->firstname),
                'lastname'=>ucfirst($x->lastname),
                'email'=>$x->email,
                'number'=>$x->number,
                'gender'=>$x->gender,
                'age'=>$x->age,
                'branch'=>$x->branch,
                'address'=>$x->address,
                'type_id'=>$x->type,

            ]);
            if(!!$x->password)
            {
                $id->update([
                    'password'=>Hash::make($x->password)
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


        return response()->json(['success'=>true], 200);
    }

    public function search(Request $request)
    {
        $employees = Employee::with('employee_type')->where('firstname','LIKE','%'.$request->search.'%')->orWhere('lastname','LIKE','%'.$request->search.'%')->paginate(7);
        return response()->json($employees, 200);
    }
    public function branch(Request $request)
    {

        $employees = Employee::with('employee_type')->where('branch',$request->branch)->paginate(7);
        return response()->json($employees, 200);
    }
    public function destroy(Employee $id)
    {
        Attendance::where('employee_id',$id->id)->delete();
        if(!!$id->photo)
        {
            unlink('storage/employee/'.$id->photo);
        }
        $id->delete();
        return response()->json(['success'=>true],200);
    }
}
