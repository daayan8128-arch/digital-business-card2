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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('company_name')->nullable();

            $table->unsignedBigInteger('premium_given_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('password');

            // Premium-related columns
            $table->boolean('is_premium')->default(false);
            $table->date('premium_start_date')->nullable();
            $table->date('premium_end_date')->nullable();

            // Role column instead of boolean admin columns
            $table->string('role', 20)->default('user'); // New column

            $table->enum('access', ['block', 'unblock'])
                  ->default('unblock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
