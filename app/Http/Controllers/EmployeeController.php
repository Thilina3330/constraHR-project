<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Site;

class EmployeeController extends Controller
{
    /**
     * සේවකයින්ගේ ලැයිස්තුව පෙන්වීම
     */
    public function index()
    {
        $employees = Employee::with('site')->latest()->get();
        return view('employe.employe', compact('employees'));
    }

    /**
     * අලුත් සේවකයෙකු ඇතුළත් කරන Form එක පෙන්වීම
     */
    public function create()
    {
        // Dropdown එකෙන් Site එකක් select කරගැනීම සඳහා Sites සියල්ල ලබා ගැනීම
        $sites = Site::all();
        return view('employe.create', compact('sites'));
    }

    /**
     * Form එකෙන් එන දත්ත Database එකේ Save කිරීම
     */
    public function store(Request $request)
    {
        // 1. Validation (දත්ත නිවැරදිදැයි පරීක්ෂා කිරීම)
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:15',
            'nic'               => 'required|string|max:15|unique:employees,nic',
            'role'              => 'required|string',
            'daily_wage'        => 'required|numeric|min:0',
            'site_id'           => 'nullable|exists:sites,Site_id',
            'joined_date'       => 'required|date',
            'emergency_contact' => 'nullable|string|max:15',
            'address'           => 'nullable|string',
        ]);

        // 2. Data සූදානම් කර ගැනීම
        $data = $request->all();

        // Attendance QR එක සඳහා Unique Code එකක් ස්වයංක්‍රීයව generate කිරීම
        $data['qr_code'] = 'EMP-' . strtoupper(uniqid());

        // 3. Database එකට Save කිරීම
        Employee::create($data);

        // 4. සාර්ථක පණිවිඩය (Success Message) සමඟ Form එකටම ආපසු යැවීම
        return redirect()->route('employees.create')->with('success', 'Employee added successfully!');
    }
}