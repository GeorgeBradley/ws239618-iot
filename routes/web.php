<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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

// Route::get('/', function () {
//     return view('index');
// })->middleware('auth')->name('home');

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'perform'])->name('logout');


Route::get('/msg', [AjaxController::class, 'insideOutsideTemperature'])->name('message');
Route::get('/avgTemp', [AjaxController::class, 'dailyAverageTemperature']);


Route::get('/msgtwo', [AjaxController::class, 'getStatuses'])->name('messageTwo');


Route::get('/turnOnInsideTemp', [AjaxController::class, 'turnOnInsideTempStatus']);
Route::get('/turnOffInsideTemp', [AjaxController::class, 'turnOffInsideTempStatus']);


Route::get('/turnOnOutsideTemp', [AjaxController::class, 'turnOnOutsideTempStatus']);
Route::get('/turnOffOutsideTemp', [AjaxController::class, 'turnOffOutsideTempStatus']);