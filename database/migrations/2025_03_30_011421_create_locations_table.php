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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('street', 45);
            $table->string('suburb', 45);
            $table->string('state', 25);
            $table->integer('pincode');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign( 'created_by')->references('id')->on('users')->nullOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign( 'updated_by')->references('id')->on('users')->nullOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
