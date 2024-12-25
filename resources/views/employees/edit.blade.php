@extends('backend')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}">
        </div>
        <div class="mb-3">
            <label for="profile" class="form-label">Profile</label>
            <input type="file" class="form-control" id="profile" name="profile" value="{{ $employee->logprofileo }}">
            @if ($employee->profile)
                <img src="{{ asset('storage/' . $employee->profile) }}" alt="Company Logo" width="150" height="150">
            @else
                <img src="{{ asset('') }}" alt="Default Logo" width="150" height="150">
            @endif
            <input type="hidden" name="oldimg" value="{{$employee->profile}}">
        </div>
        <div class="mb-3">
            <label for="company_id" class="form-label">Company</label>
            <select class="form-control" id="company_id" name="company_id" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection