<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayCounter extends Model
{
    protected $table = 'day_counters';

    protected $fillable = [
        'start_date',
        'user_id',
        'end_date',
        'total_days',
        'last_day_included'
    ];
}
