<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Benar
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete(); // Benar
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->primary(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
