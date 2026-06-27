<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtolCompliance extends Model
{
    protected $table = 'atol_compliances';

    protected $fillable = [
        'customer_id',
        'atol_certificate_number',
        'protection_date',
        'terms_accepted',
        'acknowledgement_file',
    ];

    protected $casts = [
        'protection_date' => 'date',
        'terms_accepted' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
