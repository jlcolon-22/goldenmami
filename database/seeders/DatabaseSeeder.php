<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\EmployeeType;
use Illuminate\Database\Seeder;
use App\Models\InventoryCategory;
use Illuminate\Support\Facades\Hash;
use App\Models\RestaurantInformation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'id'=>1,
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
    'password' => Hash::make('@Goldenmami2023'), // password
        'remember_token' => Str::random(10),
       ]);
    //    EmployeeType::create([
    //     'name'=>'Cher'
    //    ]);
    //    EmployeeType::create([
    //     'name'=>'Waiter'
    //    ]);

    //    InventoryCategory::create([
    //     'name'=>'General'
    //    ]);

    //    InventoryCategory::create([
    //     'name'=>'Softdrinks'
    //    ]);

    RestaurantInformation::create([
        'res_name'=>'Golden Mami House',
        'res_email'=>'goldenmami2023@gmail.com',
        'res_number'=>'0932 724 9680',
        'res_fb'=>'https://web.facebook.com/GoldenMamiHouse',
        'res_twitter'=>'http://twitter.com/GoldenMamiHouse',
        'res_instagram'=>'',
        'logo'=>'',
    ]);
    }
}
