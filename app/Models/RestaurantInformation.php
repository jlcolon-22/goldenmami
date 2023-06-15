<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantInformation extends Model
{
    use HasFactory;
    protected $fillable = ['res_name','res_email','res_number','res_fb','res_instagram','res_twitter','logo'];
}
