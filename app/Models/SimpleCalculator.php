<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleCalculator extends Model
{
    protected $fillable = ['result', 'expr', 'user_id'];
}
