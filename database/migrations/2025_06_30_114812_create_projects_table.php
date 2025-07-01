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
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                // Relasi one-to-one dengan pelajaran
                $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
                $table->text('description')->nullable(); // Deskripsi atau instruksi proyek
                $table->string('repository_url')->nullable(); // Contoh link repositori starter
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('projects');
        }
    };
    