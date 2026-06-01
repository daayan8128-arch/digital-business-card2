<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class about_us extends Model
{
    protected $fillable = [
        'about_content',
        'about_content2',
        'vision_title',
        'vision_content',
        'company_goal',
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
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
