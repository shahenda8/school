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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_id')->constrained()->cascadeOnDelete()->nullable();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->nullable();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete()->nullable();
            $table->foreignId('manager_id')->constrained()->cascadeOnDelete()->nullable();
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
