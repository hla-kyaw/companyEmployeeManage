@extends('backend')

@section('content')
<div class="container">
    <h1>{{ $company->name }}</h1>
    <p><strong>Email:</strong> {{ $company->email }}</p>
    <p><strong>Logo:</strong>
    @if ($company->logo)
        <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="150" height="150">
    @else
        <img src="{{ asset('') }}" alt="Default Logo" width="150" height="150">
    @endif</p>
    <p><strong>Website:</strong> {{ $company->website }}</p>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection