@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- Success Alert (Figma Screen 4) -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                    <span class="fs-5 me-2">✅</span> <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="fw-bold text-dark mb-0">👷 Add New Employee</h4>
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">
                            ← Back to List
                        </a>
                    </div>

                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <!-- 1. Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Enter full name" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- 2. Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       placeholder="e.g. 0771234567" 
                                       value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 3. NIC Number -->
                            <div class="col-md-6 mb-3">
                                <label for="nic" class="form-label fw-semibold">NIC Number <span class="text-danger">*</span></label>
                                <input type="text" name="nic" id="nic" 
                                       class="form-control @error('nic') is-invalid @enderror" 
                                       placeholder="e.g. 199512345678" 
                                       value="{{ old('nic') }}" required>
                                @error('nic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- 4. Role / Designation -->
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label fw-semibold">Role / Designation <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select Role</option>
                                    <option value="Laborer" {{ old('role') == 'Laborer' ? 'selected' : '' }}>Laborer (කම්කරු)</option>
                                    <option value="Mason" {{ old('role') == 'Mason' ? 'selected' : '' }}>Mason (මේසන්)</option>
                                    <option value="Carpenter" {{ old('role') == 'Carpenter' ? 'selected' : '' }}>Carpenter (වඩු කාර්මික)</option>
                                    <option value="Electrician" {{ old('role') == 'Electrician' ? 'selected' : '' }}>Electrician (විදුලි කාර්මික)</option>
                                    <option value="Plumber" {{ old('role') == 'Plumber' ? 'selected' : '' }}>Plumber (නල කාර්මික)</option>
                                    <option value="Supervisor" {{ old('role') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Site Engineer" {{ old('role') == 'Site Engineer' ? 'selected' : '' }}>Site Engineer</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 5. Daily Wage -->
                            <div class="col-md-6 mb-3">
                                <label for="daily_wage" class="form-label fw-semibold">Daily Wage (Rs.) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="daily_wage" id="daily_wage" 
                                       class="form-control @error('daily_wage') is-invalid @enderror" 
                                       placeholder="e.g. 3500.00" 
                                       value="{{ old('daily_wage') }}" required>
                                @error('daily_wage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- 6. Assigned Site -->
                            <div class="col-md-6 mb-3">
                                <label for="site_id" class="form-label fw-semibold">Assign to Site</label>
                                <select name="site_id" id="site_id" class="form-select @error('site_id') is-invalid @enderror">
                                    <option value="">Select Site (Optional)</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->Site_id }}" {{ old('site_id') == $site->Site_id ? 'selected' : '' }}>
                                            {{ $site->Site_name ?? $site->site_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('site_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 7. Joined Date -->
                            <div class="col-md-6 mb-3">
                                <label for="joined_date" class="form-label fw-semibold">Joined Date <span class="text-danger">*</span></label>
                                <input type="date" name="joined_date" id="joined_date" 
                                       class="form-control @error('joined_date') is-invalid @enderror" 
                                       value="{{ old('joined_date', date('Y-m-d')) }}" required>
                                @error('joined_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- 8. Emergency Contact -->
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact" class="form-label fw-semibold">Emergency Contact</label>
                                <input type="text" name="emergency_contact" id="emergency_contact" 
                                       class="form-control" 
                                       placeholder="Contact person number" 
                                       value="{{ old('emergency_contact') }}">
                            </div>

                            <!-- 9. Address -->
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label fw-semibold">Address</label>
                                <input type="text" name="address" id="address" 
                                       class="form-control" 
                                       placeholder="Residential address" 
                                       value="{{ old('address') }}">
                            </div>
                        </div>

                        <!-- Buttons (Figma Screen 3) -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-warning text-dark fw-semibold px-4 shadow-sm">
                                💾 Save Employee
                            </button>
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary px-4">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection