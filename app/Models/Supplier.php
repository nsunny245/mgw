<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'type',
        'contact_details',
        'contract_file',
    ];

    public function hotelBookings()
    {
        return $this->hasMany(HotelBooking::class);
    }
}
