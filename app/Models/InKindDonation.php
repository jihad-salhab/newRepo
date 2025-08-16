<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InKindDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book', 'discr_book', 'clothes', 'discr_clothes', 'shoes', 'discr_shoes',
        'other', 'discr_other', 'receipt_image', 'status', 'submitted_at'
    ];
    
    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
