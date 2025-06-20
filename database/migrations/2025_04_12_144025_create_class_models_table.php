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
        Schema::create('class_models', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->integer('no_student'); // Number of students (integer)
            $table->string( 'name'); // Class name (string)
            $table->foreignId( 'stage_id')->constrained()->cascadeOnDelete(); // Class name (string)
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_models');
    }
};
