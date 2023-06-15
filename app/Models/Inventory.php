<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';

    protected $fillable = ['branch_id','item_name','category_id','quantity','unit','status','expiration_date'];

    public function item_category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }
}
