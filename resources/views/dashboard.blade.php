@extends('backend')

@section('content')
<!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('companies.index') }}">Company</a>
</li> -->
<div class="container">
    <h1>Administrator Dashboard</h1>
    
    <div class="row mt-4">
        <!-- Total Companies -->
        <div class="col-md-6">
            <a class="nav-link" href="{{ route('companies.index') }}">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Companies</div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $totalCompanies }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Employees -->
        <div class="col-md-6">
            <a class="nav-link" href="{{ route('employees.index') }}">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Employees</div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $totalEmployees }}</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Recent Companies -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Recently Added Companies</div>
                <div class="card-body">
                    @if($recentCompanies->isEmpty())
                        <p>No companies found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCompanies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>{{ $company->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
