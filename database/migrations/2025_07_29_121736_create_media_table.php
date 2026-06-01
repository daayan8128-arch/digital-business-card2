<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Filament\Forms\Components\Upload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Url;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
              $table->foreignId('user_id')
        
              ->nullable() // or ->constrained() if user is required
              ->constrained() // creates a foreign key reference to users(id)
              ->onDelete('cascade'); // optional, deletes business detail if user is deleted
          
            $table->string('media_file')->nullable()->placeholder('Upload your media file here')->maxSize(10240); // 10MB max size
            $table->string('pdf_title')->required()->placeholder('Enter PDF title')->nullable();
            $table->string('pdf_name')->nullable()->placeholder('Enter PDF name');
            $table->text('pdf_description')->nullable()->placeholder('Enter PDF description');
            $table->string('video_url')->nullable()->placeholder('Enter video URL');
            $table->string('video_name')->nullable()->placeholder('Enter video name'); // e.g., image, video, document
            $table->text('video_description')->nullable()->placeholder('Enter video description'); // URL to the media file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
