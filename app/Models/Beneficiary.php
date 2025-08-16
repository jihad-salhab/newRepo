<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id', 'full_name', 'identity_image', 'family_members', 'home_status',
        'rent_document', 'health_status', 'describe_status', 'city', 'address', 'status', 'approved_at'
    ];

    protected $casts = [
        'home_status' => 'boolean',
        'health_status' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodBaskets()
    {
        return $this->hasMany(FoodBasket::class);
    }
}
