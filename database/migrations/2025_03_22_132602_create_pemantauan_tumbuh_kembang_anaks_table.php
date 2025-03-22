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
        Schema::create('pemantauan_tumbuh_kembang_anaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kunjungan_anak_id');
            $table->foreign('kunjungan_anak_id')->references('id')->on('kunjungan_anaks')->onDelete('cascade');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->text('perkembangan_motorik');
            $table->text('perkembangan_psikis');
            $table->date('tanggal_pemantauan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemantauan_tumbuh_kembang_anaks');
    }
};
