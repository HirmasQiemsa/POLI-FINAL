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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama',150);
            $table->string('alamat',255)->nullable();
            $table->string('no_hp')->unique();
            $table->string('password');
            $table->foreignId('id_poli')->constrained(table:'poli', indexName:'id_poli_foreign')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes(); // Soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
