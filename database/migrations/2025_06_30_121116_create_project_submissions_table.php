    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('project_submissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
                $table->string('repository_url');
                $table->string('demo_url');
                $table->enum('status', ['PENDING', 'APPROVED', 'REVISION'])->default('PENDING');
                $table->text('feedback')->nullable();
                $table->timestamps();

                // Pengguna hanya bisa mengirim satu kali untuk satu pelajaran
                $table->unique(['user_id', 'lesson_id']);
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('project_submissions');
        }
    };
    