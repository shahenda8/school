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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('salary', 10, 2); // Adjust precision as needed
            $table->string('national_id')->unique();
            $table->string('subject_name');
            $table->foreignId('stage_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('user_name')->unique();
            $table->string('phone');
            $table->date('start_date');
            $table->boolean('attend');
            $table->string('email')->unique();
            $table->string('password')->unique();
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
