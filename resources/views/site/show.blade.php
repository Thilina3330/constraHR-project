@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $site->Site_name ?? $site->site_name }}</h4>
            <small class="text-muted">Site ID: #S-{{ str_pad($site->Site_id, 3, '0', STR_PAD_LEFT) }} | Status: <span class="badge bg-success-subtle text-success fw-bold">In Progress</span></small>
        </div>
        <a href="{{ route('site.view') }}" class="btn btn-outline-secondary btn-sm">← Back to Sites</a>
    </div>

    <!-- Project Overview Card -->
    <div class="card shadow-sm border-0 p-4 mb-4">
        <h6 class="fw-bold mb-3">Project Overview</h6>
        
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="progress flex-grow-1" style="height: 12px; background-color: #E5E7EB;">
                <div class="progress-bar rounded" role="progressbar" 
                     style="width: {{ $site->progress_percentage }}%; background-color: #F59E0B;"></div>
            </div>
            <span class="fw-bold text-muted">{{ $site->progress_percentage }}%</span>
        </div>

        <div class="row text-center border-top pt-3">
            <div class="col-md-4 border-end">
                <small class="text-muted d-block">Start Date</small>
                <strong class="fs-6">{{ $site->start_date }}</strong>
            </div>
            <div class="col-md-4 border-end">
                <small class="text-muted d-block">End Date</small>
                <strong class="fs-6">{{ $site->end_date }}</strong>
            </div>
            <div class="col-md-4">
                <small class="text-muted d-block">Budget</small>
                <strong class="fs-6 text-dark">Rs. {{ number_format($site->budget, 2) }}</strong>
            </div>
        </div>
    </div>

    <!-- Activities / Tasks Breakdown -->
    <div class="card shadow-sm border-0 p-4 mb-4">
        <div class="row">
            <!-- Completed -->
            <div class="col-md-6 mb-3">
                <h6 class="fw-bold mb-3">Completed Activities</h6>
                <ul class="list-unstyled">
                    @forelse($completedTasks as $task)
                        <li class="mb-2">
                            <span class="badge rounded-circle bg-success me-2" style="padding: 5px;"> </span> 
                            {{ $task->task_name }}
                        </li>
                    @empty
                        <li class="text-muted small">No completed activities yet.</li>
                    @endforelse
                </ul>
            </div>
            <!-- In Progress / Pending -->
            <div class="col-md-6 mb-3">
                <h6 class="fw-bold mb-3">In Progress / Pending Activities</h6>
                <ul class="list-unstyled">
                    @forelse($inProgressTasks as $task)
                        <li class="mb-2">
                            <span class="badge rounded-circle bg-warning me-2" style="padding: 5px;"> </span> 
                            {{ $task->task_name }}
                        </li>
                    @empty
                    @endforelse
                    @forelse($pendingTasks as $task)
                        <li class="mb-2">
                            <span class="badge rounded-circle bg-secondary me-2" style="padding: 5px;"> </span> 
                            {{ $task->task_name }}
                        </li>
                    @empty
                    @endforelse
                    @if($inProgressTasks->isEmpty() && $pendingTasks->isEmpty())
                        <li class="text-muted small">No pending activities recorded.</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Recent Expenses Table -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 pt-3 px-4">
            <h6 class="fw-bold mb-0">Recent Expenses</h6>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentExpenses as $exp)
                        <tr>
                            <td class="ps-4">{{ $exp->expense_date }}</td>
                            <td>{{ $exp->category }}</td>
                            <td class="fw-semibold">Rs. {{ number_format($exp->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-3 text-muted">No expenses recorded for this site yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom Stats -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3 text-center">
                <span class="text-muted small fw-semibold">Workers</span>
                <h4 class="fw-bold mt-2">24</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3 text-center">
                <span class="text-muted small fw-semibold">Present</span>
                <h4 class="fw-bold mt-2 text-success">20</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3 text-center">
                <span class="text-muted small fw-semibold">Total Expense</span>
                <h4 class="fw-bold mt-2 text-danger">Rs. {{ number_format($totalSiteExpense, 2) }}</h4>
            </div>
        </div>
    </div>
</div>
@endsection