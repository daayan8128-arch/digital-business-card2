<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;
// In ContactMessage model
protected $table = 'contact_messages'; // or whatever your table is named
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'user_id'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}