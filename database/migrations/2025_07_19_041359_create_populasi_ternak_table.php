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
        Schema::create('populasi_ternak', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ternak');
            $table->integer('jumlah_duo_koto');
            $table->integer('jumlah_guguak');
            $table->integer('jumlah_baiang');
            // Generated Column for total_ternak
            $table->unsignedInteger('total_ternak')->storedAs('jumlah_duo_koto + jumlah_guguak + jumlah_baiang');
            $table->year('tahun')->nullable(); // Kolom tahun opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('populasi_ternak');
    }
};