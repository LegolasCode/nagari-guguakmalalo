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
        Schema::create('letter_services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama jenis surat (contoh: Surat Pengantar Nikah)
            $table->string('slug')->unique(); // Untuk URL
            $table->text('requirements'); // Deskripsi persyaratan (bisa berupa teks biasa atau JSON)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Admin yang membuat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_services');
    }
};