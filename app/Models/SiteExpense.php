<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteExpense extends Model
{
    protected $fillable = [
        'site_id',
        'expense_date',
        'category',
        'amount',
        'description',
    ];

    // Expense එක අයිති Site එක ලබා ගැනීම
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'Site_id');
    }
}