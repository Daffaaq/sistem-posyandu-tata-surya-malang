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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_berita');
            $table->longText('konten_berita');
            $table->string('gambar_berita');
            $table->string('slug');
            $table->enum('status', ['Pending', 'published', 'Archived'])->default('Pending');
            $table->date('tanggal_dibuat');
            $table->time('waktu_dibuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
