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

   
    public function tasks()
    {
        return $this->hasMany(SiteTask::class, 'site_id', 'Site_id');
    }

    
    public function expenses()
    {
        return $this->hasMany(SiteExpense::class, 'site_id', 'Site_id');
    }

    
    public function getProgressPercentageAttribute()
    {
        $total = $this->tasks()->count();
        if ($total == 0) return 0;
        
        $completed = $this->tasks()->where('status', 'completed')->count();
        return round(($completed / $total) * 100);
    }
        public function employees()
    {
        return $this->hasMany(Employee::class, 'site_id', 'Site_id');
    }
}