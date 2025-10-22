<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxCollection extends Model
{

    protected $table = 'tax_collections';

    protected $fillable = ['total_income', 'user_id', 'levy', 'tax', 'remaining_income', 'taxpaid', 'cost', 'payerType'];
}
