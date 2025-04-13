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
        Schema::create('imunisasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kunjungan_anak_id');
            $table->foreign('kunjungan_anak_id')->references('id')->on('kunjungan_anaks')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_imunisasi_id');
            $table->foreign('kategori_imunisasi_id')->references('id')->on('kategori_imunasasis')->onDelete('cascade');
            $table->date('tanggal_imunisasi');
            $table->date('tanggal_imunisasi_lanjutan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imunisasis');
    }
};
