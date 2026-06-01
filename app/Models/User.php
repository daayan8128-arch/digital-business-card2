<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Roles
    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_premium',
        'subscription_count',
        'premium_start_date',
        'premium_end_date',
        'premium_given_by',
        'created_by',
        'username',
        'company_name',
        'access',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'premium_start_date' => 'datetime',
        'premium_end_date' => 'datetime',
        'otp_expires_at' => 'datetime',
    ];

    // ✅ Role Checks
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPERADMIN;

    }
    /**
     * Determine if the user can access the given panel.
     *
     * @param mixed $panel
     * @return bool
     */
    public function canAccessPanel($panel): bool
    {
        return true;
    }
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    // Premium check
    public function isPremiumActive(): bool
    {
        return $this->is_premium && Carbon::now()->lt($this->premium_end_date);
    }

    // Blocked user check
    public function isBlocked(): bool
    {
        return $this->access === 'block';
    }
}
