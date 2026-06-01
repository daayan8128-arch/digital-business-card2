<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $fillable = [
        'name',
        'position',
        'feedback',
        'rating',
        'profile_image',
        'status',
        'user_id'
    ];
      public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}