<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayCounter extends Model
{
    protected $table = 'day_counters';

    protected $fillable = [
        'start_date',
        'end_date',
        'total_days',
    ];
}
