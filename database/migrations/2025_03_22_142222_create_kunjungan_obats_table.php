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
        Schema::create('kunjungan_obats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kunjungan_id');
            $table->foreign('kunjungan_id')->references('id')->on('kunjungans')->onDelete('cascade');
            $table->unsignedBigInteger('obat_id');
            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
            $table->unsignedBigInteger('kunjungan_anak_id')->nullable();
            $table->foreign('kunjungan_anak_id')->references('id')->on('kunjungan_anaks')->onDelete('cascade');
            $table->integer('jumlah_obat');
            $table->boolean('is_for_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_obats');
    }
};
