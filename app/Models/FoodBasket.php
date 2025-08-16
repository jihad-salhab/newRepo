<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBasket extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id', 'beneficiary_id', 'quantity', 'status', 'request_date', 'delivery_date'
    ];

    protected $casts = [
        'request_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
