<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'type', 'payment_method', 'status', 'donated_at'
    ];

    protected $casts = [
        'donated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
