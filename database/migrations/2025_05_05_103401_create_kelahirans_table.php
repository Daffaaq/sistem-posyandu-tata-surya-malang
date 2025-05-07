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
        Schema::create('kelahirans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kehamilan_id');
            $table->foreign('kehamilan_id')->references('id')->on('kehamilans')->onDelete('cascade');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('jenis_kelamin');
            $table->float('berat_lahir')->nullable(); // kg
            $table->float('panjang_lahir')->nullable(); // cm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelahirans');
    }
};
