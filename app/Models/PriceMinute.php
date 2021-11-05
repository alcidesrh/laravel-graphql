<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceMinute extends Model
{
    protected $table = 'price_minute';

    protected $fillable = ['price'];

    public $timestamps = false;
}
