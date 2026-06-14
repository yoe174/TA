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
        Schema::create('normalization_matrix_ahp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id_from')
                  ->constrained('criteria_ahp')
                  ->onDelete('cascade');
            $table->foreignId('criteria_id_to')
                  ->constrained('criteria_ahp')
                  ->onDelete('cascade');
            $table->decimal('normalized_value', 10, 6);
            $table->decimal('priority_vector', 10, 6)->default(0);
            $table->timestamps();

            $table->unique(['criteria_id_from', 'criteria_id_to']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normalization_matrix_ahps');
    }
};
