<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\ReservationOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['time','payment_status','date','guest','cs_id','number','branch','customer_id','payment','status'];


        public function order_item()
        {
            return $this->hasMany(ReservationOrder::class, 'reservation_id', 'id');
        }

        public function order_items()
        {
            return $this->hasManyThrough(Menu::class,ReservationOrder::class,'reservation_id','id','id','menu_id');
        }

        public function customer_info()
        {
            return $this->belongsTo(Customer::class, 'customer_id');
        }

}
