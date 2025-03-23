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
        Schema::create('jadwal_kunjungan_kbs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keluarga_berencana_id');
            $table->foreign('keluarga_berencana_id')->references('id')->on('keluarga_berencanas')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_kunjungan_kb_id');
            $table->foreign('jenis_kunjungan_kb_id')->references('id')->on('jenis_kunjungan_keluarga_berencanas')->onDelete('cascade');
            $table->date('tanggal_kunjungan_kb');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kunjungan_kbs');
    }
};
