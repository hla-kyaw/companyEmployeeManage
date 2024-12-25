@extends('backend')

@section('content')
<div class="container">
    <h1>Edit Company</h1>
    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}" required>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" value="{{ $company->logo }}">
            @if ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="150" height="150">
            @else
                <img src="{{ asset('') }}" alt="Default Logo" width="150" height="150">
            @endif
            <input type="hidden" name="oldimg" value="{{$company->logo}}">
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control" id="website" name="website" value="{{ $company->website }}">
        </div>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection