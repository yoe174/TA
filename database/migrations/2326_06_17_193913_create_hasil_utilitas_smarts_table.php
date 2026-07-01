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
        Schema::create('hasil_utilitas_smarts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_smart_id')
                  ->constrained('periode_smarts')
                  ->onDelete('restrict');
            $table->foreignId('alternatif_smart_id')
                  ->constrained('alternatif_smarts')
                  ->onDelete('restrict');
            $table->foreignId('criteria_smart_id')
                  ->constrained('criteria_smarts')
                  ->onDelete('restrict');
            $table->decimal('nilai_aktual', 10, 4);
            $table->decimal('nilai_min', 10, 4);
            $table->decimal('nilai_max', 10, 4);
            $table->decimal('nilai_utilitas', 10, 6);
            $table->timestamps();

            $table->unique([
                'periode_smart_id',
                'alternatif_smart_id',
                'criteria_smart_id',
            ], 'utilitas_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_utilitas_smarts');
    }
};
