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
        Schema::create('pemeriksaan_kehamilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kehamilan_id');
            $table->foreign('kehamilan_id')->references('id')->on('kehamilans')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan_kehamilan');
            $table->integer('usia_kandungan');
            $table->text('deskripsi_pemeriksaan_kehamilan');
            $table->text('keluhan_kehamilan')->nullable();
            $table->string('tekanan_darah_ibu_hamil')->nullable();
            $table->float('berat_badan_ibu_hamil')->nullable();
            $table->string('posisi_janin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kehamilans');
    }
};
