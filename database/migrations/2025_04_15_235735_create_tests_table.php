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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('test_type');
            $table->unsignedBigInteger('assessment_list_id')->nullable();
            $table->foreign( 'assessment_list_id')->references('id')->on('cognifit_cognitive_assessment_lists')->nullOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign( 'created_by')->references('id')->on('users')->nullOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
