<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'service_image',
        'service_name',
        'service_description',
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
