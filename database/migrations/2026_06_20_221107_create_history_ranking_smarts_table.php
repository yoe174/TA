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
        Schema::create('history_ranking_smarts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_smart_id')
                  ->unique() // 1 periode hanya 1 history
                  ->constrained('periode_smarts')
                  ->onDelete('restrict');
            $table->foreignId('alternatif_terbaik_id')
                  ->constrained('alternatif_smarts')
                  ->onDelete('restrict');
            $table->decimal('nilai_terbaik', 10, 6);
            $table->enum('status', ['valid', 'tidak_valid'])->default('valid');
            $table->text('keterangan')->nullable();
            $table->json('detail_snapshot'); // semua alternatif, kriteria, penilaian, utilitas, hasil akhir
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_ranking_smarts');
    }
};
