<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'city',
        'persons',
        'travel_date',
        'package_type',
        'message',
        'status',
        'assigned_to',
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
