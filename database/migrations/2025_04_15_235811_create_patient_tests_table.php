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
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign( 'patient_id')->references('id')->on('users')->nullOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->foreign( 'assigned_by')->references('id')->on('users')->nullOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('test_id')->nullable();
            $table->foreign( 'test_id')->references('id')->on('tests')->nullOnUpdate()->nullOnDelete();
            $table->integer('score')->default(0);
            $table->enum('status', ['PENDING','STARTED', 'COMPLETED'])->default('PENDING');
            $table->date('assign_for_date')->nullable();
            $table->date('taken_date')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_tests');
    }
};s