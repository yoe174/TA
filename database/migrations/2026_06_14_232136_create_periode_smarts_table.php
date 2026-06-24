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
        Schema::create('periode_smarts', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('bulan'); // 1-12
            $table->year('tahun');
            $table->enum('status', ['draft', 'aktif', 'selesai'])->default('draft');
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('restrict');
            $table->timestamps();

            // Satu bulan & tahun hanya boleh ada 1 periode
            $table->unique(['bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_smarts');
    }
};
