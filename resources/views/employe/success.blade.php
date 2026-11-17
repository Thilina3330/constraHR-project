@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <h4 class="fw-bold text-center mb-4">Employee Registration Successful</h4>

            <!-- Main Success Card (Desktop - 21) -->
            <div class="card shadow-sm border-0 rounded-4 p-4 text-center mb-4">
                
                <!-- Green Circle Checkmark Icon -->
                <div class="d-flex justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 75px; height: 75px; background-color: #E6F9F0;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3">Employee Successfully Registered</h5>

                <!-- Employee Info Details -->
                <div class="text-muted small mb-4" style="line-height: 1.8;">
                    <p class="mb-1"><strong>QR ID:</strong> {{ $employee->qr_id }}</p>
                    <p class="mb-1"><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                    <p class="mb-1 text-dark fs-6"><strong>Name:</strong> {{ $employee->name }}</p>
                    <p class="mb-0"><strong>Site:</strong> {{ $employee->site->Site_name ?? $employee->site->site_name }}</p>
                </div>

                <!-- Download QR Code Box -->
                <div class="border rounded-4 p-4 mx-auto my-2 shadow-sm" style="max-width: 340px; background-color: #FAFAFA;" id="printableQRCard">
                    <h6 class="fw-bold mb-3">Download QR Code</h6>
                    
                    <!-- Generated QR Code Image -->
                    <div class="bg-white p-3 rounded-3 shadow-sm d-inline-block mb-3">
                        <img id="qrImage" 
                             src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $employee->employee_id }}" 
                             alt="QR Code" 
                             class="img-fluid" 
                             style="width: 170px; height: 170px;">
                    </div>

                    <p class="text-muted" style="font-size: 11px;">Please scan employee QR code for attendance</p>

                    <!-- Download & Print Buttons -->
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-sm text-white fw-semibold px-4" style="background-color: #F59E0B;" onclick="downloadQR()">
                            Download
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark fw-semibold px-4" onclick="printQR()">
                            Print
                        </button>
                    </div>
                </div>

            </div>

            <!-- Bottom Navigation Action Card -->
            <div class="card shadow-sm border-0 rounded-4 p-3 text-center">
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('employee.index') }}" class="btn text-white fw-semibold px-4" style="background-color: #F59E0B;">
                        View Employee
                    </a>
                    <a href="{{ route('employee.create') }}" class="btn btn-outline-warning text-dark fw-semibold px-4">
                        Register Another
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- JavaScript for Download and Print QR Functions -->
<script>
    // QR Code Download 
    function downloadQR() {
        const qrUrl = document.getElementById('qrImage').src;
        fetch(qrUrl)
            .then(response => response.blob())
            .then(blob => {
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = '{{ $employee->employee_id }}_QR.png';
                link.click();
            })
            .catch(() => alert('Failed to download QR code.'));
    }

    // QR Code Print 
    function printQR() {
        const printContent = document.getElementById('printableQRCard').innerHTML;
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = `
            <div style="text-align: center; padding: 40px; font-family: sans-serif;">
                <h3 style="margin-bottom: 5px;">ConstraHR Employee ID Badge</h3>
                <h4 style="margin-bottom: 5px;">{{ $employee->name }}</h4>
                <p style="margin-bottom: 15px; color: #555;">ID: {{ $employee->employee_id }} | Site: {{ $employee->site->Site_name ?? $employee->site->site_name }}</p>
                ${printContent}
            </div>
        `;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload();
    }
</script>
@endsection