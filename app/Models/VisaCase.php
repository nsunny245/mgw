<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaCase extends Model
{
    protected $fillable = [
        'customer_id',
        'visa_type',
        'application_number',
        'submission_date',
        'appointment_date',
        'embassy',
        'officer_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'submission_date' => 'date',
        'appointment_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }
}
