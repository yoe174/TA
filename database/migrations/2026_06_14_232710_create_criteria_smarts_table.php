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
        Schema::create('criteria_smarts', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama_kriteria');
            $table->enum('jenis', ['benefit', 'cost']);
            $table->decimal('bobot', 10, 6);
            $table->boolean('use_parameter')->default(false);
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_smarts');
    }
};
