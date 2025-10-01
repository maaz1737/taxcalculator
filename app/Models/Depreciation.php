<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depreciation extends Model
{
    protected $fillable = ['cost', 'user_id', 'salvage', 'method', 'years', 'ddb_switch_to_sl', 'round'];
}
