<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'receipt',
        'reason',
        'status'
    ];
    public function userInfo()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
