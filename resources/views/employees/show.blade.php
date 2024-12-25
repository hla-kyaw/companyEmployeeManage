@extends('backend')

@section('content')
<div class="container">
    <h1>{{ $employee->name }}</h1>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Phone:</strong> {{ $employee->phone }}</p>
    <p><strong>Profile:</strong>
    @if ($employee->profile)
        <img src="{{ asset('storage/' . $employee->profile) }}" alt="Company Logo" width="150" height="150">
    @else
        <img src="{{ asset('') }}" alt="Default Logo" width="150" height="150">
    @endif</p>
    <p><strong>Company:</strong> {{ $employee->company->name }}</p>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection