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
        Schema::create('arsip_obats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obat_id');
            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
            $table->date('tanggal_arsip_obat');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_obats');
    }
};
