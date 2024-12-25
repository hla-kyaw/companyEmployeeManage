<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('company');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        $employees = $query->paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(StoreEmployeeRequest $request)
    {
       // dd($request->all());
        $validated = $request->validated();
        if ($request->hasFile('profile')) {
            $image = $request->file('profile')->store('logos', 'public');
        }
        $validated['profile'] = $image;
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        if ($request->hasFile('profile')) {
            if ($employee->profile) {
                Storage::delete("public/{$employee->profile}");
            }
            $image = $request->file('profile')->store('logos', 'public');
            $validated['profile'] = $image;
        }

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }
    public function destroy($id)
    {
        $employees=Employee::find($id);
        $employees->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');;
    }
}
