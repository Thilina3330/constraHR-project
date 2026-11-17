@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Site Expenses</h4>
            <small class="text-muted">Track and manage site construction expenses</small>
        </div>
        <!-- Modal එක open කරන Button එක -->
        <button type="button" class="btn text-white fw-bold px-4" style="background-color: #F59E0B;" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            + Record Expense
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Top Summary Cards (Total + Per Site) -->
    <div class="row g-4 mb-4">
        <!-- Total Expenses Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4">
                <span class="text-muted small fw-semibold">Total Expenses</span>
                <h2 class="fw-bold my-2" style="color: #F59E0B;">Rs. {{ number_format($totalExpenses, 2) }}</h2>
                <small class="text-muted">This Month</small>
            </div>
        </div>

        <!-- Site Breakdowns (e.g., Kegalle, Colombo) -->
        @foreach($sitesWithExpenses as $s)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4">
                    <span class="text-muted small fw-semibold">{{ $s->location ?? $s->Site_name }}</span>
                    <h2 class="fw-bold my-2" style="color: #F59E0B;">Rs. {{ number_format($s->expenses_sum_amount ?? 0, 2) }}</h2>
                    <small class="text-muted">{{ $s->Site_name ?? $s->site_name }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Expenses Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 pt-3 px-4">
            <h5 class="fw-bold mb-0">Recent Expenses</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Site</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentExpenses as $expense)
                        <tr>
                            <td class="ps-4">{{ $expense->expense_date }}</td>
                            <td>{{ $expense->site->Site_name ?? $expense->site->site_name }}</td>
                            <td>{{ $expense->category }}</td>
                            <td class="fw-semibold">Rs. {{ number_format($expense->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No expenses recorded yet. Click "+ Record Expense" to add.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Expense Modal (Popup Form) -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Record Site Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Site</label>
                        <select name="site_id" class="form-select" required>
                            <option value="" disabled selected>-- Select Site --</option>
                            @foreach($sitesWithExpenses as $site)
                                <option value="{{ $site->Site_id }}">{{ $site->Site_name ?? $site->site_name }} ({{ $site->location }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date</label>
                            <input type="date" name="expense_date" value="{{ date('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="Materials">Materials</option>
                                <option value="Transport">Transport</option>
                                <option value="Equipment">Equipment</option>
                                <option value="Labor">Labor</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount (Rs.)</label>
                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="e.g. 15000" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description (Optional)</label>
                        <input type="text" name="description" class="form-control" placeholder="Short description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn text-white fw-semibold" style="background-color: #F59E0B;">Save Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection