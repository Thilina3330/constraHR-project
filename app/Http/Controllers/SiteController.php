<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
    // Site Create Form එක පෙන්වීම
    public function index()
    {
        return view("site.create");
    }

    // Site එක Database එකට Save කිරීම
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:50',
            'budget' => 'nullable|numeric',
            'site_engineer_id' => 'required',
        ]);

        Site::create($request->all());
        return redirect()->route('site.view')->with('success', 'Site created successfully!');
    }

    // Desktop - 17: My Construction Sites List
    public function viewSite()
    {
        $sites = Site::with('tasks')->get();
        
        $activeSitesCount = $sites->count();
        $totalWorkers = 42; // Worker module එක එනතුරු sample එකක් ලෙස
        $avgProgress = $sites->count() > 0 ? $sites->avg(fn($s) => $s->progress_percentage) : 0;

        return view('site.view', compact('sites', 'activeSitesCount', 'totalWorkers', 'avgProgress'));
    }

    // Desktop - 18: Site Details View
    public function show($id)
    {
        $site = Site::with(['tasks', 'expenses'])->findOrFail($id);

        $completedTasks = $site->tasks->where('status', 'completed');
        $inProgressTasks = $site->tasks->where('status', 'in_progress');
        $pendingTasks = $site->tasks->where('status', 'pending');
        
        $recentExpenses = $site->expenses()->latest()->take(5)->get();
        $totalSiteExpense = $site->expenses()->sum('amount');

        return view('site.show', compact(
            'site', 
            'completedTasks', 
            'inProgressTasks', 
            'pendingTasks', 
            'recentExpenses', 
            'totalSiteExpense'
        ));
    }
}