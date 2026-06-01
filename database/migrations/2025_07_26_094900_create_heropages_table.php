<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('heropages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')

                ->nullable() // or ->constrained() if user is required
                ->constrained() // creates a foreign key reference to users(id)
                ->onDelete('cascade'); // optional, deletes business detail if user is deleted

            $table->string('heroimage');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heropages');
    }
};
