<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes for managing companies and employees via API. These routes
| are protected using Sanctum for authentication.
|
*/

// Public API routes (if any)

// Authenticated API routes
Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);
