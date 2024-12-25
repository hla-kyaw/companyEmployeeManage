<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total counts
        $totalCompanies = Company::count();
        $totalEmployees = Employee::count();

        // Get recent companies
        $recentCompanies = Company::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('totalCompanies', 'totalEmployees', 'recentCompanies'));
    }
}
