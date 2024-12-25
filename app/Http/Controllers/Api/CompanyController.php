<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Get all companies
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    // Create a new company
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $image = $request->file('logo')->store('logos', 'public');
        }
        $validated['logo'] = $image;
        $company = Company::create($validated);

        return response()->json($company, 201);
    }

    // Get a single company by ID
    public function show($id)
    {
        $company = Company::find($id);
        
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company);
    }

    // Update an existing company
    public function update(Request $request, $id)
    {
        //log($id);
        $company=Company::find($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required',
        ]);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }
        
        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::delete("public/{$company->logo}");
            }
            $image = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $image;

        }
        $company->update($validated);
        return response()->json($company);
    }

    // Delete a company
    public function destroy($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully']);
    }
}

