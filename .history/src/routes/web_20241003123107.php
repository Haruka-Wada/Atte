<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;

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

Route::middleware('auth')->group(function() {
    Route::get('/', [AtteController::class, 'index']);
    Route::get('/attendance', [AtteController::class, 'attendance']);
    Route::get('/attemdance/dt', [AtteController::class, ])
    Route::post('/workStart', [AtteController::class, 'workStart']);
    Route::post('/workEnd', [AtteController::class, 'workEnd']);
    Route::post('/restStart', [AtteController::class, 'restStart']);
    Route::post('/restEnd', [AtteController::class, 'restEnd']);
    Route::post('/attendance', [AtteController::class, 'changeDate']);
});
