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
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained(table:'pasien',indexName:'id_pasien_foreign')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_jadwal')->constrained(table:'jadwal_periksa',indexName:'id_jadwal_foreign')->onDelete('cascade')->onUpdate('cascade');
            $table->text('keluhan');
            $table->integer('no_antrian')->nullable();
            $table->softDeletes(); // Soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_poli');
    }
};
