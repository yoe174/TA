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
        Schema::create('comparison_matrix_ahp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id_from')
                ->references('id')->on('criteria_ahp')
                ->onDelete('cascade');
            $table->foreignId('criteria_id_to')
                ->references('id')->on('criteria_ahp')
                ->onDelete('cascade');
            $table->decimal('value', 10, 2);            
            $table->timestamps();

            $table->unique(['criteria_id_from', 'criteria_id_to']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison_matrix_ahp');
    }
};
