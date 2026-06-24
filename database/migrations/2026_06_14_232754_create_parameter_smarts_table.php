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
        Schema::create('parameter_smarts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_smart_id')
                  ->constrained('criteria_smarts')
                  ->onDelete('cascade');
            $table->string('label');
            $table->unsignedTinyInteger('nilai'); // 1-5
            $table->timestamps();

            // Nilai tiap kriteria harus unik
            $table->unique(['criteria_smart_id', 'nilai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_smarts');
    }
};
