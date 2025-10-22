<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCalculators extends Model
{

    protected $table = 'favorite_calculators';
    protected $fillable = ['title', 'name', 'text', 'user_id'];
}
