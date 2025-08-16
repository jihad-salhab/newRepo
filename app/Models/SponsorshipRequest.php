<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorshipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'orphan_id', 'duration_months', 'start_date', 'end_date', 'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orphan()
    {
        return $this->belongsTo(Orphan::class);
    }
}
