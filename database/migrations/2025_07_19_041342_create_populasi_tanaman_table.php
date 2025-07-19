<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Diperlukan untuk Generated Columns

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('populasi_tanaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_komoditi');
            $table->enum('tipe_tanaman', ['Buah-buahan', 'Perkebunan']);
            $table->integer('jumlah_duo_koto');
            $table->integer('jumlah_guguak');
            $table->integer('jumlah_baiang');
            // Generated Column for total_populasi
            // Pastikan database Anda (misalnya MySQL 5.7+ atau MariaDB 10.2.3+) mendukung GENERATED COLUMNS
            $table->unsignedInteger('total_populasi')->storedAs('jumlah_duo_koto + jumlah_guguak + jumlah_baiang');
            $table->year('tahun')->nullable(); // Kolom tahun opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('populasi_tanaman');
    }
};