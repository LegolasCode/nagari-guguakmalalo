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
        Schema::create('kelembagaan_tani', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poktan')->unique();
            $table->enum('kelas_kemampuan', ['Pemula', 'Lanjutan']);
            $table->string('id_poktan')->nullable()->unique();
            $table->integer('jumlah_anggota');
            $table->string('nama_ketua');
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat_sekretariat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelembagaan_tani');
    }
};