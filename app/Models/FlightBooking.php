<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = [
        'customer_id',
        'airline',
        'booking_reference',
        'departure_date',
        'return_date',
        'ticket_number',
        'passenger_details',
        'ticket_file_path',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'passenger_details' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
