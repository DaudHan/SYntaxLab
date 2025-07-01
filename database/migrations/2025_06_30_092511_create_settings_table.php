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
            // Tabel ini akan menyimpan pengaturan dalam format kunci-nilai
            Schema::create('settings', function (Blueprint $table) {
                $table->string('key')->primary(); // Kunci pengaturan, e.g., 'site_name'
                $table->text('value')->nullable(); // Nilai pengaturan
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('settings');
        }
    };
    