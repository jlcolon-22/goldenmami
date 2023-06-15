<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuCategory extends Model
{
    use HasFactory;
    protected $table = 'menu_categories';

    protected $fillable = ['name'];
    public function menu()
    {
        return $this->hasMany(Menu::class, 'category_id', 'id');
    }
}
