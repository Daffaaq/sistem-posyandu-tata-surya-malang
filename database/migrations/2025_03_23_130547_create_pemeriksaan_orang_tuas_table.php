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
        Schema::create('pemeriksaan_orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orang_tua_id');
            $table->foreign('orang_tua_id')->references('id')->on('orang_tuas')->onDelete('cascade');
            $table->unsignedBigInteger('kunjungan_id');
            $table->foreign('kunjungan_id')->references('id')->on('kunjungans')->onDelete('cascade');
            $table->float('tekanan_darah_ayah')->nullable();
            $table->float('tekanan_darah_ibu')->nullable();
            $table->float('gula_darah_ayah')->nullable();
            $table->float('gula_darah_ibu')->nullable();
            $table->float('kolesterol_ayah')->nullable();
            $table->float('kolesterol_ibu')->nullable();
            $table->text('catatan_kesehatan_ayah')->nullable();
            $table->text('catatan_kesehatan_ibu')->nullable();
            $table->date('tanggal_pemeriksaan_ayah');
            $table->date('tanggal_pemeriksaan_ibu');
            $table->date('tanggal_pemeriksaan_lanjutan_ayah');
            $table->date('tanggal_pemeriksaan_lanjutan_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_orang_tuas');
    }
};
