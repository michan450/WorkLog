<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RequestController;


Route::get('/register', function () {return view('auth.register');});
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'store']);
Route::middleware('auth')->group(function () {

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index'); 

    Route::get('/attendance/list', [AttendanceController::class, 'list'])
        ->name('attendance.list');

    Route::get('/attendance/detail/{id}', [AttendanceController::class, 'detail'])
        ->name('attendance.detail');    

    Route::get('/stamp_correction_request/list', [RequestController::class, 'list'])
        ->name('request.list'); 
    
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

Route::post('/attendance/clockin', [AttendanceController::class, 'clockIn'])
    ->name('attendance.clockin');

Route::post('/attendance/break-in', [AttendanceController::class, 'breakIn'])
    ->name('attendance.breakin');

Route::post('/attendance/break-out', [AttendanceController::class, 'breakOut'])
    ->name('attendance.breakout');

Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])
    ->name('attendance.clockout');    
});