<?php
// Script: scripts/fix_bank_images.php
// Usage: php scripts/fix_bank_images.php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
// Bootstrap the application fully
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\bank_detail;
use Illuminate\Support\Str;

echo "Starting fix_bank_images script...\n";
$records = bank_detail::whereNotNull('scanner_image')->get();
echo "Found " . $records->count() . " records with scanner_image.\n";

foreach ($records as $rec) {
    $scanner = $rec->scanner_image;
    if (empty($scanner)) continue;
    echo "\nRecord ID={$rec->id} scanner_image={$scanner}\n";
    $name = basename($scanner);
    $candidates = [
        public_path($name),
        public_path('uploads/' . $name),
        storage_path('app/public/' . $name),
        storage_path('app/public/scanner-images/' . $name),
        storage_path('app/public/uploads/' . $name),
    ];

    $found = null;
    foreach ($candidates as $c) {
        if (file_exists($c)) {
            $found = $c;
            echo "Found file at: $c\n";
            break;
        }
    }

    if (!$found) {
        // try fuzzy search: look for files containing sanitized base in common storage directories
        $searchBase = Str::slug(pathinfo($name, PATHINFO_FILENAME));
        echo "Searching for files containing: $searchBase ...\n";
        $dirs = [
            storage_path('app/public'),
            public_path('uploads'),
            storage_path('framework/livewire-tmp'),
            storage_path('framework/cache/data'),
            public_path(),
        ];
        foreach ($dirs as $d) {
            if (!is_dir($d)) continue;
            $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($d));
            foreach ($it as $file) {
                if ($file->isFile()) {
                    $fname = $file->getFilename();
                    if (stripos(Str::slug(pathinfo($fname, PATHINFO_FILENAME)), $searchBase) !== false) {
                        $matched = $file->getPathname();
                        echo "Fuzzy matched: $matched\n";
                        break 2;
                    }
                }
            }
        }
        if ($matched) $found = $matched;
    }

    if ($found) {
        $origName = basename($found);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $base = pathinfo($origName, PATHINFO_FILENAME);
        $safeBase = Str::slug(substr($base, 0, 50));
        $newName = time() . '_' . ($safeBase ?: 'scanner') . ($ext ? '.' . $ext : '');
        $destDir = public_path('uploads');
        if (!is_dir($destDir)) mkdir($destDir, 0755, true);
        $dest = $destDir . DIRECTORY_SEPARATOR . $newName;
        try {
            rename($found, $dest);
            $rec->scanner_image = $newName;
            $rec->save();
            echo "Moved file to: $dest and updated DB to $newName\n";
        } catch (Exception $e) {
            echo "Failed to move file: " . $e->getMessage() . "\n";
        }
    } else {
        echo "No file found for record {$rec->id}\n";
    }
}

echo "Done.\n";
