<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Get all employees
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    // Create a new employee
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|string',
            'profile' => 'mimes:jpeg,jpg,png|max:5000', // 5MB max size
            'company_id' => 'required|exists:companies,id',
        ]);
        if ($request->hasFile('profile')) {
            $image = $request->file('profile')->store('logos', 'public');
        }
        $validated['profile'] = $image;
        Employee::create($validated);
        return response()->json($employee, 201);
    }

    // Get a single employee by ID
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee);
    }

    // Update an existing employee
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'nullable|string',
            'profile' => 'nullable|mimes:jpeg,jpg,png|max:5000',
            'company_id' => 'required|exists:companies,id',
        ]);
        if ($request->hasFile('profile')) {
            if ($employee->profile) {
                Storage::delete("public/{$employee->profile}");
            }
            $image = $request->file('profile')->store('logos', 'public');
            $validated['profile'] = $image;
        }

        $employee->update($validated);
        return response()->json($employee);
    }

    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
