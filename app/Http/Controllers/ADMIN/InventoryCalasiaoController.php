<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class InventoryCalasiaoController extends Controller
{


    public function store(Request $request)
    {
        Inventory::create([
            'item_name'=>$request->item_name,
            'category_id'=>$request->item_category,
            'quantity'=>$request->quantity,
            'unit'=>$request->unit,
            'status'=>0,
            'expiration_date'=>$request->expiration_date,
            'branch_id'=>$request->branch_id,
        ]);
        return response()->json($request->all(), 200);
    }
    public function update(Request $request,Inventory $id)
    {
        $id->update([
            'item_name'=>$request->item_name,
            'category_id'=>$request->item_category,
            'quantity'=>$request->quantity,
            'unit'=>$request->unit,
            'status'=>$request->status,
            'expiration_date'=>$request->expiration_date
        ]);
        if($id->quantity < 30)
        {
            $id->update(['status'=>1]);
        }else{
            $id->update(['status'=>0]);
        }
        return response()->json(['success'=>true], 200);
    }
    public function index(Request $request)
    {

        $inventories = Inventory::with('item_category')->where('branch_id',1)->where('category_id',$request->catid)->orderBy('id','desc')->paginate(3);
        foreach($inventories as $value)
        {

            if($value->quantity < 30)
            {
                Inventory::where('id',$value->id)->update(['status'=>1]);
            }else{
                Inventory::where('id',$value->id)->update(['status'=>0]);
            }
        }

        return response()->json($inventories);
    }

    public function viewByCat()
    {
        $inventoriesCat = Inventory::with('item_category')->where('branch_id',1)->orderBy('id','desc')->get()->groupBy('category_id');
        foreach($inventoriesCat as $key => $value)
        {
            $arr[$key] = Inventory::with('item_category')->where('branch_id',1)->where('category_id',$key)->orderBy('id','desc')->get();
        }

        $data = $this->paginate($arr);

        return response()->json($data);
    }
    public function search(Request $request)
    {
        $inventory = Inventory::with('item_category')->where('item_name','LIKE','%'.$request->search.'%')->where('category_id',$request->catid)->where('branch_id',1)->orderBy('id','desc')->paginate(7);
        return response()->json($inventory);
    }
    public function destroy(Inventory $id)
    {
        $id->delete();

        return response()->json(['success'=>true], 200);
    }
    public function paginate($items, $perPage = 7, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
