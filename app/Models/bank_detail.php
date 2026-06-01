<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bank_detail extends Model
{
    protected $table = 'bank_details';
    protected $fillable = [
        'google_pay_number',
        'phonepe_number',
        'upi_id',
        'paytm_number',
        'account_name',
        'bank_name',
        'branch_name',
        'ifsc_code',
        'scanner_image',
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

        // Returns a usable URL for the scanner image by checking common storage locations.
        public function getScannerImageUrlAttribute()
        {
            $path = $this->scanner_image;
            if (empty($path)) {
                return null;
            }

            // If already a URL
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                return $path;
            }

            // Normalize
            $name = basename($path);

            // If the stored path already contains a public-relative URL path, use it directly.
            if (preg_match('#^(uploads|storage)/#i', ltrim($path, '/'))) {
                $relativePath = ltrim($path, '/');
                if (file_exists(public_path($relativePath))) {
                    return asset($relativePath);
                }
            }

            // Check public/uploads
            $publicUploads = public_path('uploads/' . $name);
            if (file_exists($publicUploads)) {
                return asset('uploads/' . $name);
            }

            // Check public path if path stored contains directories
            $publicDirect = public_path(ltrim($path, '/'));
            if (file_exists($publicDirect)) {
                // Build URL relative to public
                $relative = ltrim(str_replace(public_path(), '', $publicDirect), DIRECTORY_SEPARATOR);
                return asset($relative);
            }

            // Check storage/app/public locations (storage:link -> public/storage)
            $storagePaths = [
                storage_path('app/public/' . $name),
                storage_path('app/public/scanner-images/' . $name),
                storage_path('app/public/uploads/' . $name),
            ];
            foreach ($storagePaths as $p) {
                if (file_exists($p)) {
                    // map to /storage/ URL
                    $relative = ltrim(str_replace(storage_path('app/public'), 'storage', $p), DIRECTORY_SEPARATOR);
                    return asset($relative);
                }
            }

            // Fallback: return asset->uploads with stored name (may 404)
            return asset('uploads/' . $name);
        }
}
