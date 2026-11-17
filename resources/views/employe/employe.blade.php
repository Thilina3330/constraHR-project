@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Top Action Bar (Figma Screen 2) -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">👷 Employee Management</h3>
            <p class="text-muted small mb-0">Manage all registered construction workers, engineers, and site staff.</p>
        </div>
        
        <div class="d-flex gap-2">
            <!-- Search Box -->
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">🔍</span>
                <input type="text" id="employeeSearch" class="form-control border-start-0 ps-0" placeholder="Search employee...">
            </div>

            <!-- + Add Employee Button -->
            <a href="{{ route('employees.create') }}" class="btn btn-warning text-dark fw-semibold px-3 text-nowrap shadow-sm">
                + Add Employee
            </a>
        </div>
    </div>

    <!-- Success Message Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <span class="fs-5 me-2">✅</span> <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Employees Table Card -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="employeeTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Code</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Assigned Site</th>
                            <th>Daily Wage</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td class="ps-4 fw-bold text-primary">
                                    {{ $employee->employee_code }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-warning text-dark fw-bold d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                            {{ strtoupper(substr($employee->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $employee->name }}</div>
                                            <small class="text-muted">NIC: {{ $employee->nic }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">
                                        {{ $employee->role }}
                                    </span>
                                </td>
                                <td>
                                    <a href="tel:{{ $employee->phone }}" class="text-decoration-none text-secondary">
                                        📞 {{ $employee->phone }}
                                    </a>
                                </td>
                                <td>
                                    @if($employee->site)
                                        <span class="badge bg-info bg-opacity-10 text-primary border border-info border-opacity-25 px-2 py-1">
                                            🏗️ {{ $employee->site->Site_name ?? $employee->site->site_name }}
                                        </span>
                                    @else
                                        <span class="text-muted small">Not Assigned</span>
                                    @endif
                                </td>
                                <td class="fw-semibold text-dark">
                                    Rs. {{ number_format($employee->daily_wage, 2) }}
                                </td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        Active
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/employees/{{ $employee->id }}" class="btn btn-sm btn-outline-primary" title="View Profile">
                                        👁️ View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <div class="fs-1 mb-2">👷</div>
                                    <h6 class="fw-semibold">No Employees Found</h6>
                                    <p class="small text-muted mb-3">You haven't added any employees to the system yet.</p>
                                    <a href="{{ route('employees.create') }}" class="btn btn-warning btn-sm text-dark fw-semibold">
                                        + Add Your First Employee
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Quick Live Search Script (කිසිදු page reload එකක් නැතුව table එක filter වීමට) -->
<script>
    document.getElementById('employeeSearch').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#employeeTable tbody tr');
        
        rows.forEach(function(row) {
            let text = row.innerText.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection