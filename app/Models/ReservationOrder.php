<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationOrder extends Model
{
    use HasFactory;
    protected $fillable = ['reservation_id','menu_id','qty'];

    // public function Reservation()
    // {
    //     return $this->belongsTo(Reservation::class, 'reservation_id');
    // }

        public function menu_item_details()
        {
            return $this->belongsTo(Menu::class, 'menu_id');
        }
}
