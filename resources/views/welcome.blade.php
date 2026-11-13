@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Banner -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-7">
            <h1 class="display-4 fw-bold text-primary mb-3">ConstraHR</h1>
            <h3 class="fw-semibold text-secondary mb-3">Construction Employee Management System</h3>
            <p class="lead text-muted">
                Manage construction workforce, site operations, QR attendance, daily wages, and expenses all in one place.
            </p>
            <div class="mt-4">
    
                 <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-2">Login to System</a>
         
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4 ">Register to System</a>
            </div>
        </div>
        <div class="col-lg-5 text-center mt-4 mt-lg-0">
            <!-- Icon or Construction Illustration -->
            <i class="bi bi-buildings text-warning" style="font-size: 8rem;"></i>
        </div>
    </div>

    <!-- Feature Cards Section -->
    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">👷 Employee Management</h5>
                    <p class="card-text text-muted">Register laborers, masons, supervisors, and site engineers with their roles.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">📱 QR Code Attendance</h5>
                    <p class="card-text text-muted">Quick site check-in/out using QR codes for accurate daily attendance tracking.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">🏗️ Site & Progress Tracking</h5>
                    <p class="card-text text-muted">Monitor multiple site activities, assign site engineers, and manage daily progress.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection