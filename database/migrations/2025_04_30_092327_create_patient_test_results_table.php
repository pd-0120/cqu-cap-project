<?php

use App\Models\PatientTest;
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
        Schema::create('patient_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PatientTest::class);
            $table->datetime('date')->nullable();
            $table->string('type_key');
            $table->string('type');
            $table->integer('cognitive_age');
            $table->string('cognitive_precision');
            $table->integer('score');
            $table->json('response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_test_results');
    }
};
