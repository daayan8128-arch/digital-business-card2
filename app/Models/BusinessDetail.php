<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    use HasFactory;

   protected $fillable = [
    'photo_path',
    'name',
    'designation',
    'phone',
    'secondary_phone',
    'whatsapp',
    'email',
    'secondary_email',
    'business_name',
    'address',
    'business_hours',
    'website',
    'gstin',
    'facebook',
    'instagram',
    'linkedin',
    'twitter',
    'youtube',
    'additional_info','user_id','company_logo','tagline'
];
protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_id = auth()->id();
            }
        });
    }
    public function getPhotoPathUrlAttribute()
    {
        if (! $this->photo_path) {
            return null;
        }

        $path = collect(explode('/', $this->photo_path))
            ->map(fn ($segment) => rawurlencode($segment))
            ->implode('/');

        return asset('uploads/' . ltrim($path, '/'));
    }

    public function getCompanyLogoUrlAttribute()
    {
        if (! $this->company_logo) {
            return null;
        }

        $path = collect(explode('/', $this->company_logo))
            ->map(fn ($segment) => rawurlencode($segment))
            ->implode('/');

        return asset('uploads/' . ltrim($path, '/'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
