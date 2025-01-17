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
        Schema::create('jadwal_periksa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dokter')->constrained(table:'dokter', indexName:'id_dokter_foreign')->onDelete('cascade')->onUpdate('cascade');
            $table->string('hari',10);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            // $table->boolean('aktif');
            $table->softDeletes(); // Soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_periksa');
    }
};
