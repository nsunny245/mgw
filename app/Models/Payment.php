<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_id',
        'amount',
        'payment_date',
        'payment_method',
        'receipt_file_path',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function booted()
    {
        // Automatically calculate outstanding balances on change
        static::saved(function ($payment) {
            $customer = $payment->customer;
            if ($customer) {
                $totalPaid = $customer->payments()->sum('amount');
                $customer->update([
                    'remaining_balance' => max(0, $customer->package_value - $totalPaid)
                ]);
            }
        });

        static::deleted(function ($payment) {
            $customer = $payment->customer;
            if ($customer) {
                $totalPaid = $customer->payments()->sum('amount');
                $customer->update([
                    'remaining_balance' => max(0, $customer->package_value - $totalPaid)
                ]);
            }
        });
    }
}
