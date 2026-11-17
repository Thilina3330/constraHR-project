<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = "Site_id";

    protected $fillable = [
        'Site_name',
        'site_name',
        'start_date',
        'end_date',
        'location',
        'budget',
        'site_engineer_id',
    ];

    // Site එකට අදාළ සියලුම Tasks ලබා ගැනීම
    public function tasks()
    {
        return $this->hasMany(SiteTask::class, 'site_id', 'Site_id');
    }

    // Site එකට අදාළ සියලුම Expenses ලබා ගැනීම
    public function expenses()
    {
        return $this->hasMany(SiteExpense::class, 'site_id', 'Site_id');
    }

    // Tasks අනුව Progress percentage එක (0 - 100%) ස්වයංක්‍රීයව ගණනය කිරීම
    public function getProgressPercentageAttribute()
    {
        $total = $this->tasks()->count();
        if ($total == 0) return 0;
        
        $completed = $this->tasks()->where('status', 'completed')->count();
        return round(($completed / $total) * 100);
    }
}