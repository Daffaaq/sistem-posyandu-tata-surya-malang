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
        Schema::create('kegugurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kehamilan_id');
            $table->foreign('kehamilan_id')->references('id')->on('kehamilans')->onDelete('cascade');
            $table->date('tanggal_keguguran');
            $table->integer('usia_kandungan_saat_gugur')->nullable(); // Minggu keberapa keguguran terjadi
            $table->text('penyebab_keguguran')->nullable();           // Bisa input dokter atau ibu sendiri
            $table->text('catatan_medis')->nullable();                // Riwayat atau diagnosa dokter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegugurans');
    }
};
