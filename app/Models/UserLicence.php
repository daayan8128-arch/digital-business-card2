<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLicence extends Model
{
    use HasFactory;

    protected $table = 'user_licences';

    protected $fillable = [
        'user_id',
        'admin_id',
        'start_date',
        'end_date',
        'is_premium',
    ];

    protected $casts = [
        // DB me enum '1'/'0' hai; cast se app me boolean jaisa behave karega (optional)
        // 'is_premium' => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
