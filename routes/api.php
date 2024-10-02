<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

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

// 出勤打刻
Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
// 退勤打刻
Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');