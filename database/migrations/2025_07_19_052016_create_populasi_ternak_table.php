<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('populasi_ternak', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ternak');
            $table->integer('jumlah_duo_koto');
            $table->integer('jumlah_guguak');
            $table->integer('jumlah_baiang');
            $table->unsignedInteger('total_ternak')->storedAs('jumlah_duo_koto + jumlah_guguak + jumlah_baiang');
            $table->year('tahun')->nullable();
            
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('populasi_ternak');
    }
};


