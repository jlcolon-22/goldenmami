<?php

namespace App\Http\Controllers\ADMIN;

use Validator;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //

    public function index()
    {
        $customers = Customer::orderBy('id','desc')->paginate(7);
        return response()->json($customers, 200);
    }

    public function store(Request $request)
    {



         // $x = json_decode($request->details,true);
         $y = json_decode(($request->details),true);
         $x = (object)$y;

          $rules = [
            'nickname'=>'required',
            'email'=>'required|unique:customers',
            'number'=>'required|min:11|max:12',
            'address'=>'required',
            'email_validate'=>'required',
            'password'=>'required|min:8',
          ];
          $validator = Validator::make($y,$rules);
          if($validator->fails()) {
              return response()->json(['errors'=>$validator->errors()], 422);
          }else{

            $create = Customer::create([
                'nickname'=>$x->nickname,
                'email'=>$x->email,
                'number'=>$x->number,
                'address'=>$x->address,
                'email_validate'=>$x->email_validate,
                'password'=>Hash::make($x->password),
            ]);
              // return $request->photo;
              if(!!$request->photo)
              {

                  $filename = time().'-customer.'.$request->photo->extension();
                  $create->update([
                      'photo'=>$filename
                  ]);
                  $request->photo->storeAs('public/customer',$filename);
              }
          }
          return response()->json(['success'=>true], 200);
    }

    public function update(Request $request,Customer $id)
    {
        $x = json_decode($request->details,true);
        $y = json_decode(($request->details),true);
        $x = (object)$y;
        $id->update([
            'nickname'=>$x->nickname,
            'email'=>$x->email,
            'number'=>$x->number,
            'address'=>$x->address,
            'email_validate'=>$x->email_validate,

        ]);
        if(!!$x->password)
        {
            $id->update([
                'password'=>Hash::make($x->password)
            ]);
        }
        if($request->photo != "null")
        {
           if(!!$id->photo)
           {
            unlink('storage/customer/'.$id->photo);
           }

            $filename = time().'-customer.'.$request->photo->extension();
            $id->update([
                'photo'=>$filename
            ]);
            $request->photo->storeAs('public/customer',$filename);
        }
    }
    public function search(Request $request)
    {
        $customers = Customer::where('nickname','LIKE','%'.$request->search.'%')->orWhere('email','LIKE','%'.$request->search.'%')->orderBy('id','desc')->paginate(7);
        return response()->json($customers, 200);
    }
    public function destroy(Customer $id)
    {
        if(!!$id->photo)
           {
            unlink('storage/customer/'.$id->photo);
        }
        $id->delete();
        return response()->json(['success'=>true], 200);
    }
}
