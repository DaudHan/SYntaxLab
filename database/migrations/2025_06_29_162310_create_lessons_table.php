<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id(); // DIUBAH
            $table->foreignId('module_id')->constrained('modules')->cascadeOnDelete(); // DIUBAH
            $table->string('title');
            $table->enum('content_type', ['TEXT', 'QUIZ', 'PROJECT']);
            $table->longText('content')->nullable();
            $table->unsignedInteger('order_index');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
