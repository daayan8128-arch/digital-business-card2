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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
              $table->foreignId('user_id')
        
              ->nullable() // or ->constrained() if user is required
              ->constrained() // creates a foreign key reference to users(id)
              ->onDelete('cascade'); // optional, deletes business detail if user is deleted
          
            $table->string('portfolio_image');
            $table->string('category');
            $table->string('title');
            $table->text('description');
            $table->string('client_name')->nullable();
            $table->date('date_completed')->nullable();
            $table->string('service_type')->nullable();
            $table->string('technologies_used')->nullable();
            $table->text('about_project')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
