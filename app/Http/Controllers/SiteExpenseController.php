<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteExpense;

class SiteExpenseController extends Controller
{
    // Desktop - 22: Site Expenses Screen
    public function index()
    {
        // සියලුම Expenses අලුත්ම ඒවා මුලින් එන සේ ලබා ගැනීම
        $recentExpenses = SiteExpense::with('site')->latest()->get();
        
        // මුළු වියදම (Total Expenses)
        $totalExpenses = SiteExpense::sum('amount');

        // එක් එක් Site එක අනුව වියදම් එකතුව (Kegalle, Colombo cards සඳහා)
        $sitesWithExpenses = Site::withSum('expenses', 'amount')->get();

        return view('expenses.index', compact('recentExpenses', 'totalExpenses', 'sitesWithExpenses'));
    }

    // අලුත් Expense එකක් Save කිරීම
    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required|exists:sites,Site_id',
            'expense_date' => 'required|date',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        SiteExpense::create($request->all());

        return redirect()->back()->with('success', 'Expense recorded successfully!');
    }
}