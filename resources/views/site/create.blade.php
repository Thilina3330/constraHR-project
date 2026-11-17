@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title fw-bold mb-0">Create New Construction Site</h4>
                        <a href="{{ route('site.view') }}" class="btn btn-outline-secondary btn-sm">← Back to Sites</a>
                    </div>

                    <form action="{{ route('site.store') }}" method="POST">
                        @csrf
                        
                        <!-- Site Name -->
                        <div class="mb-3">
                            <label for="site_name" class="form-label fw-semibold">Site Name</label>
                            <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror" placeholder="e.g. Kegalle Housing Project" value="{{ old('site_name') }}" required>
                            @error('site_name') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dates (Start & End) -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', date('Y-m-d')) }}" required>
                                @error('start_date') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label fw-semibold">End Date</label>
                                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" required>
                                @error('end_date') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location & Budget -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="location" class="form-label fw-semibold">Location</label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="e.g. Kegalle" value="{{ old('location') }}" required>
                                @error('location') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="budget" class="form-label fw-semibold">Project Budget (Rs.)</label>
                                <input type="number" step="0.01" name="budget" class="form-control @error('budget') is-invalid @enderror" placeholder="e.g. 1500000" value="{{ old('budget') }}">
                                @error('budget') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Select Site Engineer -->
                        <div class="mb-4">
                            <label for="site_engineer_id" class="form-label fw-semibold">Select Site Engineer</label>
                            <select class="form-select @error('site_engineer_id') is-invalid @enderror" name="site_engineer_id" required>
                                <option value="" selected disabled>Select Engineer</option>
                                <option value="1">Amal Perera (Site Engineer #1)</option>
                                <option value="2">Sunil Shantha (Site Engineer #2)</option>
                            </select>
                            @error('site_engineer_id') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('site.view') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn fw-semibold px-4 text-white" style="background-color: #F59E0B;">Create Site</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection