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
        Schema::table('diseases', function (Blueprint $table) {
            $table->string('bulan')->nullable()->after('case_count'); // Ganti 'nama_kolom_sebelumnya' dengan nama kolom setelah kolom bulan ingin ditambahkan
            // Atau jika ingin menambahkan di akhir tabel, cukup:
            // $table->string('bulan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->dropColumn('bulan');
        });
    }
};