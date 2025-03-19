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
        Schema::create('jadwal_posyandus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan'); // Nama kegiatan posyandu
            $table->date('tanggal_kegiatan'); // Tanggal kegiatan posyandu
            $table->time('waktu_kegiatan'); // Waktu kegiatan posyandu
            $table->string('tempat_kegiatan'); // Tempat kegiatan posyandu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandus');
    }
};
