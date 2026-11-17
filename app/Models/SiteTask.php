<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteTask extends Model
{
    protected $fillable = [
        'site_id',
        'task_name',
        'status',
    ];

    // Task එක අයිති Site එක ලබා ගැනීම
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'Site_id');
    }
}