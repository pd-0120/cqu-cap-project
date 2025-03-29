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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->string('street')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('emergency_contact', 100)->nullable();
            $table->string('emergency_phone', 20)->nullable();
            $table->text('medical_history')->nullable();
            $table->decimal('cognitive_score', 5, 2)->default(0);
            $table->dateTime('last_exercise_date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Deceased'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
