@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title fw-bold mb-0">👷 Register New Employee</h4>
                        <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Employees</a>
                    </div>

                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        
                        <!-- Employee Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Kasun Perera" value="{{ old('name') }}" required>
                            @error('name') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g. 0771234567" value="{{ old('phone') }}">
                            @error('phone') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Designation / Role -->
                        <div class="mb-3">
                            <label for="designation" class="form-label fw-semibold">Designation / Role</label>
                            <select name="designation" class="form-select @error('designation') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Select Designation --</option>
                                <option value="Mason">Mason (මේසන් බාස්)</option>
                                <option value="Laborer">Laborer (කම්කරු)</option>
                                <option value="Carpenter">Carpenter (වඩු බාස්)</option>
                                <option value="Electrician">Electrician (විදුලි කාර්මික)</option>
                                <option value="Plumber">Plumber (නල කාර්මික)</option>
                                <option value="Painter">Painter (පේන්ට් බාස්)</option>
                                <option value="Site Supervisor">Site Supervisor (අධීක්ෂක)</option>
                            </select>
                            @error('designation') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Assigned Construction Site -->
                        <div class="mb-4">
                            <label for="site_id" class="form-label fw-semibold">Assigned Construction Site</label>
                            <select class="form-select @error('site_id') is-invalid @enderror" name="site_id" required>
                                <option value="" selected disabled>-- Select Construction Site --</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->Site_id }}">{{ $site->Site_name ?? $site->site_name }} ({{ $site->location }})</option>
                                @endforeach
                            </select>
                            @error('site_id') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn fw-semibold px-4 text-white" style="background-color: #F59E0B;">
                                Register & Generate QR
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection