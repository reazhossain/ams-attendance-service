<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/attendance/{from}/{to}/{id?}', [\App\Http\Controllers\AttendanceController::class, 'getAllAttendance'])->name('attendance');
Route::get('/run-attendance-push-service', [\App\Http\Controllers\AttendanceController::class, 'pushToServer'])->name('pushToServer');
