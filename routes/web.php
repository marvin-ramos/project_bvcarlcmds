<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//for login page area
Route::get('/login-page', [LoginController::class, 'index']);

//Administration area is here
Route::prefix('admin')->group(function () {

	//for dashboard area 
    Route::get('/dashboard', [AdminController::class, 'index']);

    //for employee front end
    Route::get('/employee/table', [AdminController::class, 'employee_table'])
    ->name('employee.table');
    Route::get('/employee/add', [AdminController::class, 'employee_add'])
    ->name('employee.add');
    Route::get('/employee/edit', [AdminController::class, 'employee_edit'])
    ->name('employee.edit');
    Route::get('/employee/view', [AdminController::class, 'employee_view'])
    ->name('employee.view');

    //employee functionality
    Route::post('/employee/add/store', [AdminController::class, 'employee_store'])
    ->name('employee.store');
});