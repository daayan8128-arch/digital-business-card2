<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';


    protected $fillable = [
        'portfolio_image',
        'category',
        'title',
        'description',
        'client_name',
        'date_completed',
        'service_type',
        'technologies_used',
        'about_project',
        'user_id'
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
    public function getPortfolioImageUrlAttribute()
    {
        if (! $this->portfolio_image) {
            return null;
        }

        $path = collect(explode('/', $this->portfolio_image))
            ->map(fn ($segment) => rawurlencode($segment))
            ->implode('/');

        return asset('uploads/' . ltrim($path, '/'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
