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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anak');
            $table->enum('jenis_kelamin_anak', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir_anak');
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
        Schema::dropIfExists('anaks');
    }
};
