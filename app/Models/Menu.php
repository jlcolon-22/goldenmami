<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','description','status','category_id','photo'];



    public function cart_menu()
    {
        return $this->hasMany(Cart::class, 'menu_id', 'id');
    }
    public function category_menu()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function orderReservation()
    {
        return $this->hasMany(ReservationOrder::class, 'menu_id', 'id');
    }
}
