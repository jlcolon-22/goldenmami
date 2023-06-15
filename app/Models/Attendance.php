<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','time_in','time_out','created_at','branch'];

    public $timestamps = false;

    public function attendance_employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
