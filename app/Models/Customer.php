<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['nickname','email','number','address','password','photo','email_validate'];


    public function customer_cart()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    public function reservation_details()
    {
        return $this->hasMany(Reservation::class, 'customer_id', 'id');
    }
}
