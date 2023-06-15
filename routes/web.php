<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantInformation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ADMIN\AdminReservationController;


Route::get('/send',[AdminReservationController::class,'send']);

Route::get('/', function () {
    $info = RestaurantInformation::first();
    return view('welcome',compact('info'));
});
Route::get('/menu',function()
{
    $info = RestaurantInformation::first();
    return view('pages.menu',compact('info'));
});
Route::get('/reservation',function()
{
    $info = RestaurantInformation::first();
    return view('pages.reservation',compact('info'));
});
Route::get('/contact',function()
{
    $info = RestaurantInformation::first();
    return view('pages.contact',compact('info'));
});
Route::get('/faq',function()
{
    $info = RestaurantInformation::first();
    return view('pages.faq',compact('info'));
});
Route::get('/login',function()
{
    $info = RestaurantInformation::first();
    return view('auth.login',compact('info'));
});
Route::get('/register',function()
{
    $info = RestaurantInformation::first();
    return view('auth.register',compact('info'));
});

Route::view('my','pages.my');
Route::view('reservation/list','pages.reservation_list');
Route::get('logout',function(Request $request){
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    Auth::guard('customer')->logout();
    return redirect('/login');
});
Route::get('payment/success/{id}',[ReservationController::class,'paymentSuccess']);
Route::middleware(['adminonly'])->prefix('admin')->group(function () {
    Route::view('dashboard','admin.dashboard');
    // menu
    Route::view('menu/category','admin.menu.category');
    Route::view('menu','admin.menu.menu');

    // employee
    Route::view('employees','admin.employee.employees');
    Route::view('employee/type','admin.employee.employee-type');
    Route::view('employee/attendance','admin.employee.attendance');

    // Inventory

        Route::view('inventory/calasiao','admin.inventory.calasiao.calasiao');
        Route::view('inventory/dagupan','admin.inventory.dagupan.dagupan');
        Route::view('inventory/lingayen','admin.inventory.lingayen.lingayen');
        Route::view('inventory/category','admin.inventory.category');

    // Customers
    Route::view('customers','admin.customer.customer');

    Route::view('reservation','admin.reservation.reservation');
    // Setting
    Route::view('setting','admin.setting');

    //Event
    Route::view('event','admin.event.event');
    Route::get('logout',function(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::guard('web')->logout();
        return redirect('/login');
    });
});

Route::prefix('employee')->group(function () {
    Route::view('dashboard','employee.dashboard');
    Route::view('attendance','employee.attendance');
    Route::view('setting','employee.setting');
});
Route::get('employee/logout',function(Request $request){
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    Auth::guard('employee')->logout();
    return redirect('/login');
});
