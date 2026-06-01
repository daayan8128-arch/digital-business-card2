<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_uses', function (Blueprint $table) {
            $table->id();
              $table->foreignId('user_id')
        
              ->nullable() // or ->constrained() if user is required
              ->constrained() // creates a foreign key reference to users(id)
              ->onDelete('cascade'); // optional, deletes business detail if user is deleted
          
            $table->longText('about_content');
            $table->longText('vision_title')->nullable();
            $table->longText('vision_content')->nullable();
            $table->longText('company_goal')->nullable();
            $table->longText('about_content2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_uses');
    }
};
