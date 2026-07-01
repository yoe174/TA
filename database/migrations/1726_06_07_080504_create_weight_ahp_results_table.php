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
        Schema::create('weight_ahp_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_ahp_id')->constrained('criteria_ahp')->onDelete('cascade');
            $table->decimal('bobot', 10, 6);
            $table->decimal('lambda_max', 10, 6);
             $table->decimal('ri', 10, 6)->default(0);
            $table->decimal('ci', 10, 6);
            $table->decimal('cr', 10, 6);
            $table->boolean('is_consistent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_ahp_results');
    }
};
