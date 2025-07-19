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
        Schema::create('luas_area_produksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_komoditi');
            $table->enum('tipe_area', ['Sawah', 'Tanaman Palawija']);
            $table->decimal('luas_tanam', 10, 2); // 10 digit total, 2 di belakang koma
            $table->decimal('luas_panen', 10, 2);
            $table->decimal('produksi', 10, 2);
            $table->year('tahun')->nullable(); // Kolom tahun opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luas_area_produksi');
    }
};