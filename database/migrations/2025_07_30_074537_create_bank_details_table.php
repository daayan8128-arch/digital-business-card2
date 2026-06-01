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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')

                ->nullable() // or ->constrained() if user is required
                ->constrained() // creates a foreign key reference to users(id)
                ->onDelete('cascade'); // optional, deletes business detail if user is deleted

            $table->string('google_pay_number')->nullable();
            $table->string('phonepe_number')->nullable();
            $table->string('upi_id')->nullable();
            $table->string('paytm_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('scanner_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_details');
    }
};
