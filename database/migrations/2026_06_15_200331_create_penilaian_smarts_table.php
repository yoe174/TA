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
        Schema::create('penilaian_smarts', function (Blueprint $table) {
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
            $table->foreignId('parameter_smart_id')
                ->nullable()
                ->constrained('parameter_smarts')
                ->onDelete('restrict');
            $table->decimal('nilai_manual', 10, 2)->nullable();
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('restrict');
            $table->timestamps();

            $table->unique([
                'periode_smart_id',
                'alternatif_smart_id',
                'criteria_smart_id'
            ], 'penilaian_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_smarts');
    }
};
