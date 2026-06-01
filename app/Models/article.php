<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
protected $table = 'articles';

    protected $fillable = [
        'article_image',
        'article_title',
        'article_description',
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
    // Define any relationships or additional methods if needed
        public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
