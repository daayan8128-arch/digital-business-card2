<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('business_details', function (Blueprint $table) {
            $table->id();
               $table->foreignId('user_id')
        
              ->nullable() // or ->constrained() if user is required
              ->constrained() // creates a foreign key reference to users(id)
              ->onDelete('cascade'); // optional, deletes business detail if user is deleted
            $table->string('photo_path')->nullable();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email');
            $table->string('business_name')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->string('gstin')->nullable();

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('tagline')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_details');
    }
};