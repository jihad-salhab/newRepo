<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $fillable = [
        'name', 'email', 'phone', 'city', 'role', 'password_hash', 'is_verified'
    ];

    protected $hidden = [
    'password',
    'remember_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    // Relations
    public function beneficiary()
    {
        return $this->hasOne(Beneficiary::class);
    }

    public function orphans()
    {
        return $this->hasMany(Orphan::class);
    }

    public function financialDonations()
    {
        return $this->hasMany(FinancialDonation::class);
    }

    public function inKindDonations()
    {
        return $this->hasMany(InKindDonation::class);
    }

    public function sponsorshipRequests()
    {
        return $this->hasMany(SponsorshipRequest::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
