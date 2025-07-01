<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Benar
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete(); // Benar
            $table->enum('status', ['SELESAI', 'DILEWATI'])->default('SELESAI');
            $table->timestamp('completed_at');
            $table->timestamps();
            $table->primary(['user_id', 'lesson_id']);
        });
    }    

    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
