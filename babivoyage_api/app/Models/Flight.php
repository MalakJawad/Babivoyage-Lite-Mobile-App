<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'airline','flight_no','from_code','to_code','date',
        'depart_time','arrive_time','duration_min','non_stop',
        'price','cabin','status',
    ];
}