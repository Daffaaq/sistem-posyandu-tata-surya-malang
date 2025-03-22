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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kunjungan');
            $table->text('deskripsi_kunjungan');
            $table->unsignedBigInteger('tipe_kunjungan_id');
            $table->foreign('tipe_kunjungan_id')->references('id')->on('type_kunjungans')->onDelete('cascade');
            $table->unsignedBigInteger('orang_tua_id');
            $table->foreign('orang_tua_id')->references('id')->on('orang_tuas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
