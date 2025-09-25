<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    protected $fillable = ['user_id', 'calc_type', 'inputs', 'outputs'];

    protected $casts = [
        'inputs'  => 'array',
        'outputs' => 'array',
    ];
}
