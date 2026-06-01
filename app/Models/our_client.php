<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class our_client extends Model
{
    protected $fillable =['client_company_logo','user_id'];
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
