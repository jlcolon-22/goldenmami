<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ADMIN\MenuController;
use App\Http\Controllers\ADMIN\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FrontendMenuController;
use App\Http\Controllers\ADMIN\SettingController;
use App\Http\Controllers\ADMIN\CustomerController;
use App\Http\Controllers\ADMIN\DashboardController;
use App\Http\Controllers\ADMIN\EmployeesController;
use App\Http\Controllers\ADMIN\AttendanceController;
use App\Http\Controllers\ADMIN\EmployeeTypeController;
use App\Http\Controllers\ADMIN\MenuCategoryController;
use App\Http\Controllers\ADMIN\AdminReservationController;
use App\Http\Controllers\ADMIN\InventoryDagupanController;
use App\Http\Controllers\ADMIN\InventoryCalasiaoController;
use App\Http\Controllers\ADMIN\InventoryCategoryController;
use App\Http\Controllers\ADMIN\InventoryLingayenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/login',[AuthController::class,'adminLogin']);
Route::post('/auth/register',[AuthController::class,'register']);
Route::middleware(['adminonly'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('count',[DashboardController::class,'index']);
    Route::get('graph',[DashboardController::class,'graph']);

    // menu/cateogry
    Route::post('menu/category',[MenuCategoryController::class,'store']);
    Route::get('menu/category/all',[MenuCategoryController::class,'fetch']);
    Route::get('menu/category/global',[MenuCategoryController::class,'allCategory']);
    Route::delete('menu/category/{id}',[MenuCategoryController::class,'destroy']);
    Route::put('menu/category/{id}',[MenuCategoryController::class,'update']);
    // menu
    Route::post('menu',[MenuController::class,'store']);
    Route::post('menu/search',[MenuController::class,'search']);
    Route::post('menu/{id}',[MenuController::class,'update']);
    Route::get('menu/all',[MenuController::class,'index']);
    Route::delete('menu/delete/{id}',[MenuController::class,'destroy']);

    // Employees
    Route::post('employee/add',[EmployeesController::class,'store']);
    Route::get('employees',[EmployeesController::class,'index']);
    Route::post('employee/update/{id}',[EmployeesController::class,'update']);
    Route::delete('employee/delete/{id}',[EmployeesController::class,'destroy']);
    Route::post('employee/search',[EmployeesController::class,'search']);
    Route::get('employee/search/branch',[EmployeesController::class,'branch']);

    // employeeType
    Route::post('employee/type/add',[EmployeeTypeController::class,'store']);
    Route::get('employee/type/global',[EmployeeTypeController::class,'allType']);
    Route::get('employee/types',[EmployeeTypeController::class,'index']);
    Route::post('employee/type/update/{id}',[EmployeeTypeController::class,'update']);
    Route::delete('employee/type/delete/{id}',[EmployeeTypeController::class,'destroy']);
    // Employee Attendance
    Route::get('employee/attendance',[AttendanceController::class,'index']);
    Route::get('employee/attendance',[AttendanceController::class,'search']);
    Route::get('employee/attendance/branch/search',[AttendanceController::class,'branch']);

    // customers
    Route::get('customers',[CustomerController::class,'index']);
    Route::post('customer/search',[CustomerController::class,'search']);
    Route::post('customer/add',[CustomerController::class,'store']);
    Route::post('customer/update/{id}',[CustomerController::class,'update']);
    Route::delete('customer/delete/{id}',[CustomerController::class,'destroy']);

    // Setting
    Route::post('setting',[SettingController::class,'store']);
    Route::get('setting/show',[SettingController::class,'show']);
    Route::prefix('inventory')->group(function () {
        Route::get('category/global',[InventoryCategoryController::class,'all']);

        Route::post('calasiao/add',[InventoryCalasiaoController::class,'store']);
        Route::post('calasiao/update/{id}',[InventoryCalasiaoController::class,'update']);
        Route::delete('calasiao/delete/{id}',[InventoryCalasiaoController::class,'destroy']);
        Route::post('calasiao/search',[InventoryCalasiaoController::class,'search']);
        Route::get('calasiao/all',[InventoryCalasiaoController::class,'index']);
        Route::get('calasiao/all/cat',[InventoryCalasiaoController::class,'viewByCat']);

        Route::post('dagupan/add',[InventoryDagupanController::class,'store']);
        Route::post('dagupan/update/{id}',[InventoryDagupanController::class,'update']);
        Route::delete('dagupan/delete/{id}',[InventoryDagupanController::class,'destroy']);
        Route::post('dagupan/search',[InventoryDagupanController::class,'search']);
        Route::get('dagupan/all',[InventoryDagupanController::class,'index']);
        Route::get('dagupan/all/cat',[InventoryDagupanController::class,'viewByCat']);

        Route::post('lingayen/add',[InventoryLingayenController::class,'store']);
        Route::post('lingayen/update/{id}',[InventoryLingayenController::class,'update']);
        Route::delete('lingayen/delete/{id}',[InventoryLingayenController::class,'destroy']);
        Route::post('lingayen/search',[InventoryLingayenController::class,'search']);
        Route::get('lingayen/all',[InventoryLingayenController::class,'index']);
        Route::get('lingayen/all/cat',[InventoryLingayenController::class,'viewByCat']);

        Route::post('category',[InventoryCategoryController::class,'store']);
        Route::post('category/update/{id}',[InventoryCategoryController::class,'update']);
        Route::delete('category/delete/{id}',[InventoryCategoryController::class,'destroy']);
        Route::get('categories',[InventoryCategoryController::class,'index']);
    });

    // Event
    Route::post('event/add',[EventController::class,'store']);
    Route::post('event/update/{id}',[EventController::class,'update']);
    Route::delete('event/delete/{id}',[EventController::class,'destroy']);
    Route::get('events',[EventController::class,'index']);

    Route::get('reservation/list',[AdminReservationController::class,'index']);
    Route::post('reservation/approved/{id}',[AdminReservationController::class,'approved']);
    Route::delete('reservation/delete/{id}',[AdminReservationController::class,'destroy']);
    Route::get('reservation/search',[AdminReservationController::class,'search']);
});

Route::prefix('frontend')->group(function () {
    Route::post('menus',[FrontendMenuController::class,'index']);
    Route::get('dashboard/menu',[FrontendMenuController::class,'dashboardMenu']);
    Route::get('menu/categories',[FrontendMenuController::class,'categories']);
    Route::get('my',[FrontendMenuController::class,'my']);
    Route::post('my/update',[FrontendMenuController::class,'myUpdate']);

    // cart
    Route::post('cart/add',[CartController::class,'store']);
    Route::get('cart/customer',[CartController::class,'customerCart']);
    Route::delete('cart/item/delete/{id}',[CartController::class,'destroy']);
    Route::post('cart/qty/update',[CartController::class,'updateQty']);

    // reservation
    Route::post('reservation/payment',[ReservationController::class,'store']);
    Route::get('reservation/list',[ReservationController::class,'reservation_list']);

    // contact
    Route::post('contact/add',[ContactController::class,'store']);
});
Route::prefix('employee')->group(function () {
    Route::get('events',[EventController::class,'all']);
    Route::post('attendance/add',[EventController::class,'addAttendance']);
    Route::get('attendance/show',[EventController::class,'showAttendance']);
    Route::get('attendance',[EventController::class,'allAttendance']);
    Route::post('setting/update/{id}',[EventController::class,'updateEmp']);
});
