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
        Schema::create('hasil_akhir_smarts', function (Blueprint $table) {
            $table->id();
             $table->foreignId('periode_smart_id')
                  ->constrained('periode_smarts')
                  ->onDelete('restrict');
            $table->foreignId('alternatif_smart_id')
                  ->constrained('alternatif_smarts')
                  ->onDelete('restrict');
            $table->decimal('nilai_total', 10, 6);
            $table->unsignedInteger('rangking');
            $table->timestamps();

            $table->unique([
                'periode_smart_id',
                'alternatif_smart_id',
            ], 'hasil_akhir_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_akhir_smarts');
    }
};
