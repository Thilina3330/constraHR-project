<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'qr_id',
        'name',
        'phone',
        'designation',
        'site_id',
        'status',
    ];

    
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'Site_id');
    }
}