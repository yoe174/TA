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
        Schema::create('criteria_ahp', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria');
            $table->string('kode')->unique();
            $table->enum('jenis', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_ahp');
    }
};
