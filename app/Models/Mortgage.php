<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mortgage extends Model
{
    protected $fillable = [
        "price",
        "down_amount",
        "years",
        "apr_percent",
        "annual_property_tax",
        "annual_home_insurance",
        "pmi_percent",
        "hoa_monthly",
        "start_date",
        'user_id'
    ];
}
