<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
//use Intervention\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

use App\Http\Middleware\AdminMiddleware;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function __construct($value='')
    {
        $this->middleware('AdminMiddleware',['except'=>['index','show']]);
    }*/
    public function index(Request $request)
    {
        if (auth()->user()->role === 'User') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }
        $query = Company::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('website', 'like', "%$search%");
            });
        }

        $companies = $query->paginate(5);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        if (auth()->user()->role === 'User') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to perform this action.');
        }
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $image = $request->file('logo')->store('logos', 'public');
        }
        $validated['logo'] = $image;
        Company::create($validated);
        return redirect()->route('companies.index')->with('success', 'Company created successfully');
    }

    public function show(Company $company)
    {
        if (auth()->user()->role === 'User') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to perform this action.');
        }
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        if (auth()->user()->role === 'User') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to perform this action.');
        }
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
         $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::delete("public/{$company->logo}");
            }
            $image = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $image;
        }
        $company->update($validated);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }
    public function destroy($id)
    {
        $companies=Company::find($id);
        $companies->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');;
    }
}
