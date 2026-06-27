<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'inquiry_id',
        'full_name',
        'email',
        'mobile',
        'passport_number',
        'nationality',
        'address',
        'date_birth',
        'package_id',
        'departure_city',
        'travel_date',
        'return_date',
        'agent_id',
        'lead_source',
        'status',
        'package_value',
        'deposit_amount',
        'remaining_balance',
        'notes',
    ];

    protected $casts = [
        'date_birth' => 'date',
        'travel_date' => 'date',
        'return_date' => 'date',
        'package_value' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function timelineEvents()
    {
        return $this->hasMany(TimelineEvent::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function digitalSignatures()
    {
        return $this->hasMany(DigitalSignature::class);
    }

    public function visaCases()
    {
        return $this->hasMany(VisaCase::class);
    }

    public function flightBookings()
    {
        return $this->hasMany(FlightBooking::class);
    }

    public function hotelBookings()
    {
        return $this->hasMany(HotelBooking::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function atolCompliances()
    {
        return $this->hasMany(AtolCompliance::class);
    }
}
