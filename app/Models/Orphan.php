<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'full_name', 'symbolic_name', 'age', 'city', 'avatar',
        'is_sponsored', 'father_death_cert', 'mother_death', 'mother_death_cert',
        'monthly_cost', 'address', 'relative_phone', 'status', 'max_sponsorship_months', 'approved_at'
    ];

    protected $casts = [
        'is_sponsored' => 'boolean',
        'mother_death' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sponsorshipRequests()
    {
        return $this->hasMany(SponsorshipRequest::class);
    }
}
