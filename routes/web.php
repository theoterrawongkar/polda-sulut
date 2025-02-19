<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->middleware('throttle:5,5');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/karyawan', [EmployeeController::class, 'index'])->name('dashboard.employees.index');
    Route::get('/karyawan/tambah', [EmployeeController::class, 'create'])->name('dashboard.employees.create');
    Route::post('/karyawan/tambah', [EmployeeController::class, 'store'])->name('dashboard.employees.store');
    Route::get('/karyawan/{nrp}', [EmployeeController::class, 'show'])->name('dashboard.employees.show');
    Route::get('/karyawan/{nrp}/ubah', [EmployeeController::class, 'edit'])->name('dashboard.employees.edit');
    Route::put('/karyawan/{nrp}/ubah', [EmployeeController::class, 'update'])->name('dashboard.employees.update');
    Route::delete('/karyawan/{nrp}/hapus', [EmployeeController::class, 'destroy'])->name('dashboard.employees.delete');

    Route::get('/absensi-saya', [AttendanceController::class, 'show'])->name('dashboard.attendances.show');
    Route::get('/input-presensi', [AttendanceController::class, 'create'])->name('dashboard.attendances.create');
    Route::post('/input-presensi', [AttendanceController::class, 'store'])->name('dashboard.attendances.store');
    Route::get('/kelola-presensi', [AttendanceController::class, 'indexEmployeeAttendance'])->name('dashboard.attendances.indexEmployeeAttendance');
    Route::get('/kelola-presensi/{nrp}', [AttendanceController::class, 'showEmployeeAttendance'])->name('dashboard.attendances.showEmployeeAttendance');
    Route::post('/kelola-presensi/{nrp}/tambah', [AttendanceController::class, 'storeEmployeeAttendance'])->name('dashboard.attendances.storeEmployeeAttendance');
    Route::put('/kelola-presensi/{nrp}/{attendanceId}', [AttendanceController::class, 'updateEmployeeAttendance'])->name('dashboard.attendances.updateEmployeeAttendance');
});
