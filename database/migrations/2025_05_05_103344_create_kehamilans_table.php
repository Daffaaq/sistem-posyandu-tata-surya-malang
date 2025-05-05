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
        Schema::create('kehamilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orang_tua_id');
            $table->foreign('orang_tua_id')->references('id')->on('orang_tuas')->onDelete('cascade');
            $table->enum('status_kehamilan', ['Hamil', 'Melahirkan', 'Gugur'])->default('Hamil');
            $table->date('tanggal_mulai_kehamilan');
            $table->date('prediksi_tanggal_lahir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehamilans');
    }
};
