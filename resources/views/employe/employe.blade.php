@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">👷 Employee Management</h4>
            <small class="text-muted">Manage construction site workers, roles, and QR identity badges</small>
        </div>
        <a href="{{ route('employee.create') }}" class="btn text-white fw-bold px-4" style="background-color: #F59E0B;">
            + Register New Employee
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Employees List Table
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Emp ID</th>
                            <th>Name</th>
                            <th>Designation / Role</th>
                            <th>Assigned Site</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-center">QR Badge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $emp)
                            <tr>
                                <td class="ps-4">{{ $loop->iteration }}</td>
                                <td><span class="badge bg-secondary font-monospace">{{ $emp->employee_id }}</span></td>
                                <td class="fw-bold">{{ $emp->name }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">{{ $emp->designation }}</span>
                                </td>
                                <td>{{ $emp->site->Site_name ?? $emp->site->site_name }}</td>
                                <td>{{ $emp->phone ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('employee.success', $emp->id) }}" class="btn btn-sm btn-outline-dark fw-semibold px-3">
                                        📱 View QR
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <p class="mb-2 fs-5">No employees registered yet.</p>
                                    <a href="{{ route('employee.create') }}" class="btn btn-warning fw-semibold">+ Register First Employee</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection