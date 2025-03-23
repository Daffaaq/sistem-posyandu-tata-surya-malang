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
        Schema::create('keluarga_berencanas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orang_tua_id');
            $table->foreign('orang_tua_id')->references('id')->on('orang_tuas')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_keluarga_berencana_id');
            $table->foreign('kategori_keluarga_berencana_id')->references('id')->on('kategori_keluarga_berencanas')->onDelete('cascade');
            $table->date('tanggal_mulai_keluarga_berencana');
            $table->date('tanggal_selesai_keluarga_berencana');
            $table->text('catatan_keluarga_berencana')->nullable();
            $table->enum('is_active', ['Active', 'Non-Active']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_berencanas');
    }
};
