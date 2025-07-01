<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id(); // DIUBAH
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete(); // DIUBAH
            $table->string('title');
            $table->unsignedInteger('order_index');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
