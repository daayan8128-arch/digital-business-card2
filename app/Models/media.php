<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class media extends Model
{
   protected $table = 'media';

    protected $fillable = [
        'media_file', // Assuming this is the file upload field
        'pdf_title',
        'pdf_name',
        'pdf_description',
        'video_url',
        'video_name', // e.g., image, video, document
        'video_description', // URL to the media file
        'user_id', // ID of the user who uploaded the media 
    ];
        public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
    // Define any relationships or additional methods if needed
}
