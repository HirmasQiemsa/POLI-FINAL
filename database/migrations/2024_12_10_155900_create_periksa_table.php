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
        Schema::create('periksa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_daftar_poli')->constrained(table:'daftar_poli',indexName:'id_daftar_poli_foreign')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tgl_periksa');
            $table->text('catatan');
            $table->integer('biaya_periksa')->nullable();
            $table->softDeletes(); // Soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksa');
    }
};
