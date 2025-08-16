<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false; // لأننا نستخدم created_at 

    protected $fillable = [
        'user_id', 'title', 'message', 'type', 'is_read', 'related_entity'
    ];

    
    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
