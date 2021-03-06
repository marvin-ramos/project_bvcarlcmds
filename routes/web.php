<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChartsApiController;

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
Route::get('/chart', [ChartsApiController::class, 'index'])->name('api.chart');
Route::get('/card', [HomeController::class, 'card'])->name('card');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//for login page area
Route::get('/login-page', [LoginController::class, 'index'])
       ->name('view.login');
Route::post('/login/action', [LoginController::class, 'login_action'])
->name('login.action');

//dashboard page
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('check_users_login')
->name('main.dashboard');

//for change password
Route::post('/edit/password', [AdminController::class, 'change_password']);

//for administrator route
Route::group(['prefix' => 'admin',  'middleware' => 'check_users_login'], function()
{
    //for employee front end
    Route::get('/employee/table', [AdminController::class, 'employee_table'])
         ->name('employee.table');
    Route::get('/employee/add', [AdminController::class, 'employee_add'])
         ->name('employee.add');
    Route::get('/employee/edit/{id}', [AdminController::class, 'employee_edit'])
         ->name('employee.edit');
    Route::get('/employee/view/{id}', [AdminController::class, 'employee_view'])
         ->name('employee.view');

    //employee functionality
    Route::post('/employee/add/store', [AdminController::class, 'employee_store'])
         ->name('employee.store');
    Route::post('/employee/edit/update/{id}', [AdminController::class, 'employee_update'])
         ->name('employee.update');
    Route::get('/employee/delete/{id}', [AdminController::class, 'employee_delete'])
         ->name('employee.delete');

    //account front-end
    Route::get('/account/add/{id}', [AdminController::class, 'account_add'])
         ->name('account.add');
    Route::get('/account/table', [AdminController::class, 'account_table'])
         ->name('account.table');
    Route::get('/account/view/{id}', [AdminController::class, 'account_view'])
         ->name('account.view');

    //for user activity area
     Route::get('/admin/activities', [AdminController::class, 'admin_activities'])
         ->name('admin.activities');
             
    //for history area
    Route::get('/table/history', [AdminController::class, 'history_table'])
         ->name('history.table');

    //for admin profile area
    Route::get('/admin/profile', [AdminController::class, 'admin_profile'])
         ->name('admin.profile');

    //account functionality
    Route::post('/account/add/store', [AdminController::class, 'account_store']);

    //for change password area
    Route::get('/admin/change', [AdminController::class, 'admin_change'])
         ->name('admin.change');

    //for admin logout area
    Route::get('/logout', [AdminController::class, 'logout'])
         ->name('admin.logout');
});

//for staff route
Route::group(['prefix' => 'staff',  'middleware' => 'check_users_login'], function()
{
    //for change password area
    Route::get('/change', [StaffController::class, 'staff_change'])
         ->name('staff.change');

    //for user activities
    Route::get('/staff/activities', [StaffController::class, 'staff_activities'])
         ->name('staff.activities');

    //for dashboard area 
    Route::get('/logout', [StaffController::class, 'logout'])
         ->name('staff.logout');

    //for admin profile area
    Route::get('/staff/profile', [StaffController::class, 'staff_profile'])
         ->name('staff.profile');
});