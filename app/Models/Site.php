<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey="site_id";

    protected $fillable = [
        'site_name',
        'start_date',
        'end_date',
        'location',
        'site_engineer_id',


    ];

}
