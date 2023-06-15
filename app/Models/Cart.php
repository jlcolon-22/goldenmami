<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','menu_id','qty'];

    public function customer_cart_menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function customer_details()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
