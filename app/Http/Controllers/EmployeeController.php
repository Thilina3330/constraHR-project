<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Site;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::with('site')->latest()->get();
        return view('employe.employe', compact('employees'));
    }

    
    public function create()
    {
        $sites = Site::all();
        return view('employe.create', compact('sites'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'designation' => 'required|string',
            'site_id' => 'required|exists:sites,Site_id',
        ]);

        
        $count = Employee::count() + 1;
        $employee_id = 'EMP-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        $qr_id = 'QR-' . str_pad($count, 6, '0', STR_PAD_LEFT);

        $employee = Employee::create([
            'employee_id' => $employee_id,
            'qr_id' => $qr_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'site_id' => $request->site_id,
            'status' => 'active',
        ]);

        
        return redirect()->route('employee.success', $employee->id);
    }

    // Desktop - 21: Employee Registration Successful View
    public function success($id)
    {
        $employee = Employee::with('site')->findOrFail($id);
        return view('employe.success', compact('employee'));
    }
}