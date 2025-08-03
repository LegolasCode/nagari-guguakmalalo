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
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Pengguna yang mengajukan
            $table->foreignId('letter_service_id')->constrained('letter_services')->onDelete('cascade'); // Jenis layanan yang diminta
            $table->string('request_number')->unique(); // Nomor unik untuk request (opsional)
            $table->enum('status', ['pending', 'processing', 'completed', 'rejected'])->default('pending'); // Status surat
            $table->string('completed_file_path')->nullable(); // File surat yang sudah selesai diunggah admin
            $table->text('admin_notes')->nullable(); // Catatan dari admin (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};