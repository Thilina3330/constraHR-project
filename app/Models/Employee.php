<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'nic',
        'role',
        'daily_wage',
        'site_id',
        'joined_date',
        'emergency_contact',
        'address',
        'qr_code',
        'status',
    ];

    /**
     * සේවකයා අයිති Site එක ලබා ගැනීමට Relationship එක
     */
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'Site_id');
    }

    /**
     * Employee Code එක (උදා: EMP-0001) ලබා ගැනීමට Accessor එකක්
     */
    public function getEmployeeCodeAttribute()
    {
        return 'EMP-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }
}