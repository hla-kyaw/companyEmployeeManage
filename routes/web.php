<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;




Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::middleware(['auth', 'admin'])->group(function () {
Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});