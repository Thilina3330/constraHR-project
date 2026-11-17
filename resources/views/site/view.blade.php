@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">My Construction Sites</h4>
            <small class="text-muted">Manage active construction projects and their progress</small>
        </div>
        <a href="{{ route('site.create') }}" class="btn text-white fw-bold px-4" style="background-color: #F59E0B;">+ Add New Site</a>
    </div>

    <!-- Site Cards List -->
    <div class="d-flex flex-column gap-3 mb-5">
        @forelse($sites as $site)
            <div class="card shadow-sm border-0 rounded-3 p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $site->Site_name ?? $site->site_name }}</h5>
                        <small class="text-muted">Site ID: #S-{{ str_pad($site->Site_id, 3, '0', STR_PAD_LEFT) }} | 24 workers</small>
                    </div>
                    <a href="{{ route('site.show', $site->Site_id) }}" class="btn btn-sm btn-dark px-4 fw-semibold">View</a>
                </div>

                <!-- Progress Bar -->
                <div class="d-flex align-items-center gap-3">
                    <div class="progress flex-grow-1" style="height: 10px; background-color: #E5E7EB;">
                        <div class="progress-bar rounded" role="progressbar" 
                             style="width: {{ $site->progress_percentage }}%; background-color: #F59E0B;"></div>
                    </div>
                    <small class="fw-bold text-muted">{{ $site->progress_percentage }}%</small>
                </div>
            </div>
        @empty
            <div class="card p-4 text-center text-muted">No sites available yet. Click "+ Add New Site" to create one.</div>
        @endforelse
    </div>

    <!-- Bottom Summary Stats -->
    <div class="row g-4 mt-auto">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3 text-center">
                <span class="text-muted small fw-semibold">Active Sites</span>
                <h3 class="fw-bold mt-2" style="color: #F59E0B;">{{ $activeSitesCount }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3 text-center">
                <span class="text-muted small fw-semibold">Total Workers</span>
                <h3 class="fw-bold mt-2" style="color: #F59E0B;">{{ $totalWorkers }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3 text-center">
                <span class="text-muted small fw-semibold">Avg. Overall Progress</span>
                <h3 class="fw-bold mt-2" style="color: #F59E0B;">{{ round($avgProgress) }}%</h3>
            </div>
        </div>
    </div>
</div>
@endsection