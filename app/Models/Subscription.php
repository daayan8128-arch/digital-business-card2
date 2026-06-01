<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_by',
        'admin_id', // changed
        'start_date',
        'end_date',
        'total_premium_users',
        'remaining_premium_users',
    ];

    protected static function booted()
    {
        static::creating(function ($subscription) {
            $user = Auth::user();

            if ($user->is_super_admin) {
                $subscription->end_date = $subscription->end_date ?? null;
            } elseif ($user->is_admin) {
                $subscription->start_date = $subscription->start_date ?? now();
                $subscription->end_date = Carbon::parse($subscription->start_date)->addYear();
            }
        });
    }

    // Relations
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
