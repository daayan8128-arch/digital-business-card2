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
        Schema::create('our_partners', function (Blueprint $table) {
            $table->id();
              $table->foreignId('user_id')
        
              ->nullable() // or ->constrained() if user is required
              ->constrained() // creates a foreign key reference to users(id)
              ->onDelete('cascade'); // optional, deletes business detail if user is deleted
          
            $table->string('company_logo'); // Column for company logo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_partners');
    }
};
