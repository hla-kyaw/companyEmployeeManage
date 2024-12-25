@extends('backend')

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-10 col-12">
            <h2>Companies</h2>
        </div>
        
        <!-- Right Column -->
        <div class="col-md-2 col-12">
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Add New Company</a>
        </div>
    </div>
    <form action="{{ route('companies.index') }}" method="GET" class="mb-3 col-md-5 col-12">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search companies..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{route('companies.destroy',$company)}}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')

                              <input type="submit" name="submitbtn" class="btn btn-danger btn-sm" value="Delete">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $companies->appends(request()->input())->links() }}
</div>
@endsection