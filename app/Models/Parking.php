<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\CarType;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $table = 'parking';

    protected $fillable = ['plate', 'car_in', 'car_out', 'amount', 'car_type_id'];

    public function carType(){
        return $this->belongsTo(CarType::class);
    }

    public function getMinutesAttribute()
    {
        if ($this->car_out) {
            return (new Carbon($this->car_out))->diffInMinutes(new Carbon($this->car_in));
        }

        return null;
    }
}
