<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
			$table->text('medical_history')->change()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
			$table->string('medical_history')->change()->nullable();
        });
    }
};
