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
        Schema::create('criteria_finals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_ahp_id')
                  ->constrained('criteria_ahp')
                  ->onDelete('restrict'); // sengaja restrict, jangan cascade
            $table->string('kode');
            $table->string('nama_kriteria');
            $table->enum('jenis', ['benefit', 'cost']);
            $table->decimal('bobot', 10, 6);
            $table->decimal('cr', 10, 6);   // bukti forensik saat ekspor
            $table->boolean('is_consistent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_finals');
    }
};
