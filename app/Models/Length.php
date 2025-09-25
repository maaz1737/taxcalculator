<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Length extends Model
{

    protected $table = 'lengths';
    protected $fillable = ['category', 'user_id', 'from_unit', 'to_unit', 'value', 'result'];
}
