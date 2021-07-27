<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;

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

Route::get('/admin', function () {
    return view('user.admin');
});

Route::get('/manager', function () {
    return view('user.manager');
});

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::get('/login/employee', [LoginController::class, 'showEmployeeLoginForm']);
Route::get('/register/employee', [RegisterController::class,'showEmployeeRegisterForm']);

Route::post('/login/employee', [LoginController::class,'employeeLogin']);
Route::post('/register/employee', [RegisterController::class,'createEmployee']);

Route::group(['middleware' => 'auth:employee'], function () {
    Route::get('/employee', [EmployeeController::class, 'index']);
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', [UserController::class, 'index']);
});

Route::get('/logout', [LoginController::class,'logout']);

