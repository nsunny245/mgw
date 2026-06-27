<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmrahCalendar extends Model
{
    protected $fillable = [
        'package_id',
        'month',
        'year',
        'start_date',
        'end_date',
        'price',
        'status',
        'notes',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
