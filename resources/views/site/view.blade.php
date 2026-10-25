@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Sites List</h3>
        <a href="/create-site" class="btn btn-warning text-dark fw-semibold">+ Create New Site</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Site Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Site Engineer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sites as $site)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $site->Site_name ?? $site->site_name }}</td>
                                <td>{{ $site->start_date }}</td>
                                <td>{{ $site->end_date }}</td>
                                <td>{{ $site->location }}</td>
                                <td>Engineer #{{ $site->site_engineer_id }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No sites found yet. <a href="/create-site">Create one now</a>!
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