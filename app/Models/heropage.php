<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class heropage extends Model
{

    protected $fillable = ['heroimage', 'title', 'subtitle','user_id'];
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
